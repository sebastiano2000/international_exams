<?php

namespace App\Imports;

use App\Models\Answer;
use App\Models\Paragraph;
use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportParagraph implements ToArray
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $subjectId;

    public function __construct($subjectId)
    {
        $this->subjectId = $subjectId;
    }

    public function model(array $row)
    {
        dd($row);
        if (empty($row[0])) {
            return null;
        }

        if (!empty($row[5])) {
            $paragraph = Paragraph::create(
                [
                    'title' => $row[5],
                ]
            );
        }
        else {
            $paragraph = Paragraph::latest()->first();
        }

        $question = Question::create(
            [
                'title' => $row[0],
                'paragraph_id' => $paragraph->id,
                'subject_id' => $this->subjectId,
            ]
        );

        $answers = [];
        $answers[] = $answer_1 = $row[1];
        $answers[] = $answer_2 = $row[2];
        $answers[] = $answer_3 = $row[3];
        $answers[] = $answer_4 = $row[4];

        shuffle($answers);

        for ($i = 0; $i < count($answers); $i++) {
            if (trim($answers[$i]) == trim($answer_1)) {
                Answer::create(
                    [
                        'question_id' => $question->id,
                        'title' => $answers[$i],
                        'status' => 1,
                    ]
                );
            } else {
                Answer::create(
                    [
                        'question_id' => $question->id,
                        'title' => $answers[$i],
                        'status' => 0,
                    ]
                );
            }
        }

        return $question;
    }

    public function array(array $array)
    {
        foreach($array as $key => $row){
            if (empty($row[0])) {
                return null;
            }
    
            if (!empty($row[5])) {
                $paragraph = Paragraph::create(
                    [
                        'title' => trim($row[5]),
                    ]
                );
            }
            else {
                $paragraph = Paragraph::where('title', trim($array[$key-($key%5)][5]))->first();
            }

            $question = Question::create(
                [
                    'title' => $row[0],
                    'paragraph_id' => $paragraph->id,
                    'subject_id' => $this->subjectId,
                ]
            );
    
            $answers = [];
            $answers[] = $answer_1 = $row[1];
            $answers[] = $answer_2 = $row[2];
            $answers[] = $answer_3 = $row[3];
            $answers[] = $answer_4 = $row[4];
    
            shuffle($answers);
    
            for ($i = 0; $i < count($answers); $i++) {
                if (trim($answers[$i]) == trim($answer_1)) {
                    Answer::create(
                        [
                            'question_id' => $question->id,
                            'title' => $answers[$i],
                            'status' => 1,
                        ]
                    );
                } else {
                    Answer::create(
                        [
                            'question_id' => $question->id,
                            'title' => $answers[$i],
                            'status' => 0,
                        ]
                    );
                }
            }
        }

        return $array;
    }
}
