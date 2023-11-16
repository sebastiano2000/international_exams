<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'subject_id',
        'notes',
        'paragraph_id',
        'demo'
    ];
    
    public static function upsertInstance($request)
    {
        if($request->paragraph){
            $paragraph = Paragraph::updateOrCreate(
                [
                    'title' => $request->paragraph,
                ],
                [
                    'title' => $request->paragraph,
                ]
            );
        }

        $question = Question::updateOrCreate(
            [
                'id' => $request->id ?? null
            ],
            [
                'title' => $request->name,
                'notes' => $request->notes ?? null,
                'paragraph_id' => $paragraph->id ?? null,
                'subject_id' => $request->subject_id,
            ]
        );

        $question->answers()->delete();

        foreach($request->title as $key => $title){
            Answer::create(
                [
                    'question_id' => $question->id,
                    'title' => $title,
                    'status' => $request->status[$key],
                ]
            );
        }

        return $question;
    }

    public function scopeFilter($query, $request)
    {
        if (isset($request['name'])) {
            $query->where('title', 'like', '%' . $request['name'] . '%');
        }

        return $query;
    }

    public function deleteInstance()
    {
        $this->answers()->delete();
        return $this->delete();
    }
    
    static function deleteAll($request)
    {
        return Question::whereIn('id', $request->id)->delete();
    }

    static function removeAll($request)
    {
        $questions = Question::where('demo', 0)->whereNot('subject_id', 3)->delete();

        return  $questions;
    }

    static function removeAllParagraph($request)
    {
        $questions = Question::where('demo', 0)->where('subject_id', 3)->delete();

        return  $questions;
    }
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    
    public function paragraph()
    {
        return $this->belongsTo(Paragraph::class, 'paragraph_id');
    }
}
