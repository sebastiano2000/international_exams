<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'phone',
        'email',
        'message'
    ];
    
    static function upsertInstance($request)
    {
        $Contact = Contact::updateOrCreate(
            [
                'id' => $request->id ?? null,
            ],
                $request->all()
            );

        return $Contact;
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
    

}
