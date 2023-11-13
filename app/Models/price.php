<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    use softDeletes;


    protected $fillable = [
        'name', "price",
    ];


    public static function upsertInstance($request)
    {
        //updating the package 
       
        if( Price::updateOrCreate(
            [
                'id' => $request->id ?? null
            ],
            [
                'name' => $request->name,
                'price' => $request->price,
            ]
        )


        )
        {



            if($request->id){
                //  dd("updated successfully");
              
            }else{
                // dd("added successfully");
            }

            return 1;
        }
   

    }




    public function scopeFilter($query, $request)
    {
        if (isset($request['name'])) {
            $query->where('name', 'like', '%' . $request['name'] . '%');
        }

        return $query;
    }



}
