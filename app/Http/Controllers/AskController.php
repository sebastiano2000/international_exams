<?php

namespace App\Http\Controllers;

use App\Models\Ask;
use Auth;
use Illuminate\Http\Request;

class AskController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.ask.index', [
                'asks' => Ask::filter($request->all())->paginate(50),
            ]);
        } else {
            abort(404);
        }
    }

    public function filter(Request $request)
    {
        return view('admin.pages.ask.index', [
            'asks' => Ask::filter($request->all())->paginate(50),
        ]);
    }
}
