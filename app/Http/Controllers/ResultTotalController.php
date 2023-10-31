<?php

namespace App\Http\Controllers;

use App\Models\ResultTotal;
use Auth;
use Illuminate\Http\Request;

class ResultTotalController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.total.index',[
                'results' => ResultTotal::filter($request->all())->paginate(50),
            ]);
        else 
            abort(404);
    }

    public function enterTotal(Request $request)
    {
        $result = ResultTotal::enterTotal($request);

        return view('admin.pages.total.total',[
            'result' => $result,
        ]);
    }

    public function filter(Request $request)
    {
        return view('admin.pages.total.index',[
            'results' => ResultTotal::filter($request->all())->paginate(50)
        ]);
    }
}
