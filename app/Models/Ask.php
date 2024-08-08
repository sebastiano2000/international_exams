<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ask extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'user_id',
    ];

    static function upsertInstance($request)
    {
        return Ask::updateOrCreate(
            [
                'id' => $request->id ?? null,
            ],
            [
                'title' => $request->title,
                'user_id' => Auth::user()->id,
            ]);
    }

    public function scopeFilter($query, $request)
    {
        if ( isset($request['name']) ) {
            $query->where('title','like','%'.$request['name'].'%');
        }

        return $query;
    }
}
