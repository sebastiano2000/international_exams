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


        
            // if (Auth::user()->isAdmin()) {

            //     $prices = Price::paginate(50);

             
            //     return view('admin.pages.prices', [
            //         'prices' => $prices
            //     ]);
            // } else {
            //     abort(404);
            // }


            if (Auth::user()->isAdmin()) {
                return view('admin.pages.prices.index', [
                    'prices' => Price::filter($request->all())->orderBy("price","desc")->paginate(50),
                ]);
            } else {
                abort(404);
            }

    }

    /**
     * Show the form for creating a new resource.
     */


     public function upsert(Price $price){
    

        if (Auth::user()->isAdmin()) {
            return view('admin.pages.prices.upsert', [
                'price' => $price,
            ]);
        } else {
            abort(404);
        }


     }

    public function create()
    {
        
    }

    public function filter(Request $request){

        if (Auth::user()->isAdmin()) {
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, price $price)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(price $price)
    {
     
        $price->delete();
    }
}
