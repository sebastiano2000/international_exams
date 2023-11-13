<?php

namespace App\Http\Controllers;

use App\Models\price;
use Illuminate\Http\Request;
use Auth;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.prices.index', [
                'prices' => Price::filter($request->all())->orderBy("price","desc")->paginate(50),
            ]);
        } else {
            abort(404);
        }
    }

     public function upsert(Price $price)
     {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.prices.upsert', [
                'price' => $price,
            ]);
        } else {
            abort(404);
        }
    }

    public function indexHome(Request $request)
    {
        return view('pricing', [
            'prices' => Price::filter($request->all())->orderBy("price","desc")->paginate(50),
        ]);
    }


    public function filter(Request $request){
    if (Auth::user()->isAdmin()) 
    {
        return view('admin.pages.prices.index', [
            'prices' => Price::filter($request->all())->paginate(50),
        ]);

    } else {
        abort(404);
    }

       
    }


    public function modify(Request $request){
        return Price::upsertInstance($request);
    }



    public function destroy(price $price)
    {
     
        $price->delete();
    }
}
