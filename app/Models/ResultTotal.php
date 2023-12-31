<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResultTotal extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'total_id',
        'score',
    ];

    static function enterTotal($request)
    {
        $answers = UserTotal::where('user_id', Auth::user()->id)->get();

        $total = $answers->pluck('result')->sum();

        $user_result = ResultTotal::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'total_id' => $request->total_id,
            ],
            [
                'user_id' => Auth::user()->id,
                'total_id' => $request->total_id,
                'score' => $total,
            ]
        );

        $user = User::where('id', Auth::user()->id)->update(['finish' => 1]);

        return $user_result;
    }

    public function scopeFilter($query, $request)
    {
        if (isset($request['name'])) {
            $query->whereHas('user', function ($query) use($request) {
                $query->where('name', $request['name']);
            })->get();
        }

        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
