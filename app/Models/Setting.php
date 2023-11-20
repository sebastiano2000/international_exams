<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'number',
    ];
    
    static function upsertInstance($request)
    {
        $setting = Setting::find(1);
        
        $setting->number = $setting->number +1;

        $setting->save();

        return $setting;
    }

}
