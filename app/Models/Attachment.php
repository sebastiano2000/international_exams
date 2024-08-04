<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class Attachment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];
    
    static function upsertInstance($request)
    {
        $attachment = Attachment::updateOrCreate(
            [
                'id' => $request->id ?? null,
            ],
                $request->all()
            );

        
        if ($request->file('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            // $destinationPath = storage_path() . '/attachments/';
            Storage::disk('public')->put($filename, $file);
// dd($filename, $file->hashName());
            // $file->move($destinationPath, $filename);

            $attachment->picture()->updateOrCreate(
                [
                    'imageable_id' => $attachment->id,
                    'second_id' => $file->hashName(),
                    'use_for' => 'attachment'
                ],
                [
                    'name' => $filename,
                    'second_id' => $file->hashName(),
                    'use_for' => 'attachment'
                ]);
        }

        return $attachment;
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
        return $this->morphOne(Gallary::class,'imageable')->where('use_for', 'attachment');
    }
}
