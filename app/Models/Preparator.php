<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preparator extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];
    
    static function upsertInstance($request)
    {
        $preparator = Preparator::updateOrCreate(
            [
                'id' => $request->id ?? null,
            ],
                $request->all()
            );

        
        if ($request->file('picture')[0] ?? null) {
            foreach($request->file('picture') as $index => $file) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/preparators/';
                $file->move($destinationPath, $filename);

                $preparator->picture()->updateOrCreate(
                    [
                        'imageable_id' => $preparator->id,
                        'use_for' => 'picture',
                        'second_id' => $index
                    ],
                    [
                        'second_id' => $index,
                        'name' => $filename,
                        'use_for' => 'picture'
                    ]);
            }
        } else {
            foreach($preparator->picture as $index => $picture) {
                if(!in_array($picture->name,$request->old_picture ?? [])) {
                    $picture->delete();
                }
            }
        }

        return $preparator;
    }
    
    public function scopeFilter($query,$request)
    {
        if ( isset($request['name']) ) {
            $query->where('name','like','%'.$request['name'].'%');
        }

        return $query;
    }
    
    public function deleteInstance()
    {
        return $this->delete();
    }
    
    public function picture()
    {
        return $this->morphMany(Gallary::class,'imageable')->where('use_for','picture');
    }
}
