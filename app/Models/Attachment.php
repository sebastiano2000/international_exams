<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class Attachment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];
    
    static function upsertInstance($request)
    {
        $file = $request->file('file');
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $filename = time() . '.' . $file->getClientOriginalExtension();
    
            $path = Storage::disk('public')->put($filename, $file);
            // unlink($file->getPathname());
            
            $attachment = Attachment::updateOrCreate(
                [
                    'id' => $request->id ?? null,
                ],
                    $request->all()
                );
    
            $attachment->picture()->updateOrCreate(
                [
                    'imageable_id' => $attachment->id,
                    'use_for' => 'attachment'
                ],
                [
                    'name' => $filename,
                    'second_id' => $file->hashName(),
                    'use_for' => 'attachment'
                ]);
                    
            return $attachment;
        }
        return true;
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
