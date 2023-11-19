<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\UserResult;
use App\Models\UserTest;
use Auth;
use Illuminate\Http\Request;
use App\Imports\ImportQuestion;
use App\Imports\ImportParagraph;
use App\Models\Subject;
use App\Models\UserTotal;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    public function exam(Request $request)
    {
        $page = !empty($request->input('page')) ? $request->input('page') : '1';
        $perpage = '1';
        $offset = ($page - 1) * $perpage;
        
        if ($page == '1') {
            Auth::user()->update(['finish' => 0]);
            UserResult::where('user_id', Auth::user()->id)->delete();
            session()->put('exam.data', null);
        }
        
        $count = Question::where('subject_id', $request->subject_id)->count();
        $total = Subject::where('id', $request->subject_id)->first()->questions_count;

        $total = $count > $total ? $total : $count;
        $array_questions = session()->get('exam.data');

        if($array_questions && $array_questions->where('id', $array_questions->pluck('id')->first())->where('subject_id', $request->subject_id)->first()){
            $array_question = null;

            if($array_questions->last()){
                if($array_questions->last()->paragraph_id){
                    $array_question = Question::where('paragraph_id', $array_questions->last()->paragraph_id)->whereNotIn('id', $array_questions->pluck('id'))->orderBy('id', 'asc')->with('answers')->take(1)->first();
                }
            }
            else {
                $array_question = Question::whereNotIn('id', $array_questions->pluck('id'))->where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->first();
            }

            if(!$array_question){
                $array_question = Question::whereNotIn('id', $array_questions->pluck('id'))->where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->first();
            }

            if($array_question){
                $array_questions->push($array_question);
            }
            else {
                $array_questions = Question::inRandomOrder()->where('subject_id', $request->subject_id)->with('answers')->take(1)->get();
            }
        }
        else {
            $array_questions = Question::inRandomOrder()->where('subject_id', $request->subject_id)->with('answers')->take(1)->get();

            if($array_questions->first()->paragraph_id){
                $array_questions = Question::where('paragraph_id', $array_questions->first()->paragraph_id)->orderBy('id', 'asc')->with('answers')->take(1)->get();
            }
        }

        session()->put('exam.data', $array_questions);

        $slice = $array_questions->slice($offset, 1);

        return view('admin.pages.exam.index')
            ->with('slice', $slice)
            ->with('page', $page)
            ->with('total', $total);
    }

    public function test(Request $request)
    {
        $page = !empty($request->input('page')) ? $request->input('page') : '1';
        $perpage = '1';
        $offset = ($page - 1) * $perpage;
        $count = Question::count();

        $back_questions = session()->get('test.data') ?? [];

        // if(count($back_questions) > 10){
        //     array_shift($back_questions);
        // }

        $temp = -1;

        foreach ($back_questions as $key => $back_question) {
            if ($back_question[$offset] ?? null) {
                $temp = $key;
            }
        }

        if($back_questions && $temp != -1 && !empty($request->input('page'))){
            $question = Question::where('id', $back_questions[$temp][$offset]['id'])->where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->first();

            if(!$question){
                $array_questions = UserTest::where('user_id', Auth::user()->id)->pluck('question_id');

                if($array_questions){
                    $question = Question::whereNotIn('id', $array_questions)->where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->first();
                }
                else {
                    $question = Question::where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->get();
                }

                if(!$question){
                    UserTest::where('user_id', Auth::user()->id)->delete();
                    $question = Question::where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->first();
                }

                $offset_array[$offset] = [ 'id' => $question->id ];
                array_push($back_questions, $offset_array);

                session()->put('test.data', $back_questions);
            }
        }
        else {
            if(empty($request->input('page'))){
                UserTest::where('user_id', Auth::user()->id)->delete();
            }

            $array_questions = UserTest::where('user_id', Auth::user()->id)->pluck('question_id');
            
            if(count($array_questions) > 0){
                $last = Question::where('id', $array_questions->last())->first();
                $question = null;
                // dd($array_questions->toArray());
                if($last->paragraph_id){
                    $question = Question::where('paragraph_id', $last->paragraph_id)->whereNotIn('id', $array_questions->toArray())->orderBy('id', 'asc')->with('answers')->take(1)->first();
                }

                if (!$question) {
                    $question = Question::whereNotIn('id', $array_questions)->where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->first();
                }
            }
            else {
                $question = Question::where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->first();
            }
            
            if (!$question) {
                UserTest::where('user_id', Auth::user()->id)->delete();
                $question = Question::where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->first();
            }

            $offset_array[$offset] = ['id' => $question->id];
            array_push($back_questions, $offset_array);
        }

        session()->put('test.data', $back_questions);

        return view('admin.pages.exam.test')
            ->with('slice', $question)
            ->with('page', $page)
            ->with('total', $count);
    }

    public function index(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.question.index', [
                'questions' => Question::whereNot('subject_id', 3)->where('demo' , 0)->filter($request->all())->paginate(50),
                'subjects' => Subject::all(),
            ]);
        } else {
            abort(404);
        }
    }

    public function finalExam (Request $request)
    {
        $page = !empty($request->input('page')) ? $request->input('page') : '1';
        $perpage = '1';
        $offset = ($page - 1) * $perpage;

        if ($page == '1') {
            Auth::user()->update(['finish' => 0]);
            UserTotal::where('user_id', Auth::user()->id)->delete();
            session()->put('final.exam', null);
        }

        $total1 = Subject::where('id', 1)->first()->questions_count;
        $total2 = Subject::where('id', 2)->first()->questions_count;
        $total3 = Subject::where('id', 3)->first()->questions_count;
        $subject_id = 2;

        $array_questions = session()->get('final.exam');

        if($array_questions){
            $count = $array_questions->where('subject_id', 2)->count();

            if($count == 35){
                $subject_id = 1;
                
                $count2 = $array_questions->where('subject_id', 1)->count();

                if($count2 == 35){
                    $subject_id = 3;
                }
            }

            if($subject_id == 3){
                $array_question = Question::whereNotIn('id', $array_questions->pluck('id'))->where('paragraph_id', $array_questions->last()->paragraph_id)->inRandomOrder()->where('subject_id', $subject_id)->with('answers')->take(1)->first();

                if(!$array_question){
                    $array_question = Question::whereNotIn('id', $array_questions->pluck('id'))->inRandomOrder()->where('subject_id', $subject_id)->with('answers')->take(1)->first();
                }
            }
            else {
                $array_question = Question::whereNotIn('id', $array_questions->pluck('id'))->inRandomOrder()->where('subject_id', $subject_id)->with('answers')->take(1)->first();
            }

            if($array_question){
                $array_questions->push($array_question);
            }
            else {
                $array_questions = Question::inRandomOrder()->where('subject_id', $subject_id)->with('answers')->take(1)->get();
            }
        }
        else {
            $array_questions = Question::inRandomOrder()->where('subject_id', $subject_id)->with('answers')->take(1)->get();
        }

        session()->put('final.exam', $array_questions);

        $slice = $array_questions->slice($offset, 1);

        return view('admin.pages.exam.final')
            ->with('slice', $slice)
            ->with('page', $page)
            ->with('total', $total1 + $total2 + $total3);
    }

    public function try(Request $request)
    {
        $page = !empty($request->input('page')) ? $request->input('page') : '1';        
        $total = $request->subject_id == 3 ? 5 : 10;

        $array_questions = Question::where('subject_id', $request->subject_id)->where('demo', 1)->with('answers')->take($page)->get();

        if($request->subject_id == 3){
            $array_questions = Question::where('paragraph_id', $array_questions->first()->paragraph_id)->orderBy('id', 'asc')->with('answers')->take($page)->get();
        }

        $array_questions = $array_questions->last();

        return view('admin.pages.exam.try')
            ->with('slice', $array_questions)
            ->with('page', $page)
            ->with('total', $total);
    }

    public function deleteAll(Request $request)
    {
        return Question::deleteAll($request);
    }

    public function removeAll(Request $request)
    {
        return Question::removeAll($request);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upsert(Question $question)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.question.upsert', [
                'subjects' => Subject::all(),
                'question' => $question,
            ]);
        } else {
            abort(404);
        }
    }

    public function modify(QuestionRequest $request)
    {
        return Question::upsertInstance($request);
    }

    public function import(Request $request)
    {
        Excel::import(new ImportQuestion($request->subject_id), $request->file('file')->store('files'));

        return redirect()->back();
    }

    public function destroy(Question $question)
    {
        return $question->deleteInstance();
    }

    public function filter(Request $request)
    {
        return view('admin.pages.question.index', [
            'questions' => Question::filter($request->all())->where('demo' , 0)->whereNot('subject_id', 3)->paginate(50),
            'subjects' => Subject::all(),
        ]);
    }
}
