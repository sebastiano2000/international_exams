<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Imports\ImportParagraph;
use App\Models\Question;
use App\Models\Subject;
use Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ParagraphController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.paragraph.index', [
                'questions' => Question::where('subject_id', 3)->where('demo' , 0)->filter($request->all())->paginate(50),
                'subjects' => Subject::all(),
            ]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upsert(Question $question)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.paragraph.upsert', [
                'subjects' => Subject::all(),
                'question' => $question,
            ]);
        } else {
            abort(404);
        }
    }
    
    public function filter(Request $request)
    {
        return view('admin.pages.paragraph.index', [
            'questions' => Question::filter($request->all())->where('demo' , 0)->where('subject_id', 3)->paginate(50),
            'subjects' => Subject::all(),
        ]);
    }

    public function modify(QuestionRequest $request)
    {
        return Question::upsertInstance($request);
    }

    public function removeAll(Request $request)
    {
        return Question::removeAllParagraph($request);
    }

    public function importParagraph(Request $request)
    {
        Excel::import(new ImportParagraph($request->subject_id), $request->file('file')->store('files'));

        return redirect()->back();
    }

    public function destroy(Question $question)
    {
        return $question->deleteInstance();
    }
}
