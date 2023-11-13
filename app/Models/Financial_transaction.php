<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial_transaction extends Model
{
    use HasFactory;

    protected $fillable = ['total_amount', 'user_id', 'resultCode', 'paymentToken', 'paymentId', 'paidOn', 'orderReferenceNumber', 'variable1', 'variable2', 'variable3', 'variable4', 'variable5', 'method', 'administrativeCharge', 'paid', 'package_number'];

    public function scopeFilter($query, $request)
    {            
        if ( isset($request['name']) ) {
            $query->where(function($query) use ($request){
                $query->whereHas('user', function($q) use($request){
                    $q->where('name','like','%'.$request['name'].'%');
                });
            });
        }
    
        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function package()
    {
        return $this->belongsTo(Price::class, 'package_number');
    }
}
