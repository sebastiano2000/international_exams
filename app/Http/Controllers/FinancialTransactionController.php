<?php

namespace App\Http\Controllers;

use App\Models\Financial_transaction;
use Auth;
use Illuminate\Http\Request;

class FinancialTransactionController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.financial.index',[
                'financial_transactions' => Financial_transaction::filter($request->all())->orderByDesc('created_at', 'desc')->paginate(50),
            ]);
        else 
            abort(404);
    }

    public function filter(Request $request)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.financial.index',[
                'financial_transactions' => Financial_transaction::filter($request->all())->orderByDesc('created_at', 'desc')->paginate(50),
            ]);
        else 
            abort(404);
    }
}
