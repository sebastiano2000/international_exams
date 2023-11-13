<?php

namespace App\Http\Controllers;

use App\Models\Financial_transaction;
use Auth;
use Illuminate\Http\Request;

class FinancialTransactionController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->isSuperAdmin())
            return view('admin.pages.financial.index',[
                'financial_transactions' => Financial_transaction::filter($request->all())->orderByDesc('created_at')->paginate(50),
            ]);
        elseif(Auth::user()->role_id == 2){
            return view('admin.pages.financial.index',[
                'financial_transactions' => Financial_transaction::WhereHas('tenancy', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })->orderByDesc('created_at')->paginate(50),
            ]);
        }
        elseif(Auth::user()->role_id == 3){
            return view('admin.pages.financial.index',[
                'financial_transactions' => Financial_transaction::where('tenant_id', Auth::user()->id)->orderByDesc('created_at')->paginate(50)
            ]);
        }
        else 
            abort(404);
    }

    public function filter(Request $request)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.financial.index',[
                'financial_transactions' => Financial_transaction::filter($request->all())->orderByDesc('created_at')->paginate(50),
            ]);
        elseif(Auth::user()->role_id == 2){
            return view('admin.pages.financial.index',[
                'financial_transactions' => Financial_transaction::WhereHas('tenancy', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })->orderByDesc('created_at')->paginate(50),
            ]);
        }
        elseif(Auth::user()->role_id == 3){
            return view('admin.pages.financial.index',[
               'financial_transactions' => Financial_transaction::where('tenant_id', Auth::user()->id)->orderByDesc('created_at')->paginate(50)
            ]);
        }
        else 
            abort(404);
    }
}
