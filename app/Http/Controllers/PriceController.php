<?php

namespace App\Http\Controllers;

use App\Models\Price;
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


    /**
     * Display the specified resource.
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Price $price)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Price $price)
    {
     
        $price->delete();
    }
}
