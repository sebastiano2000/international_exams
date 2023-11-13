<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Auth;

class ContactController extends Controller
{
    public function adminIndex(Request $request)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.contact.index',[
                'contacts' => Contact::filter($request->all())->paginate(10),
        
            ]);
        else 
            abort(404);
    }

    public function filter(Request $request)
    {
        if(Auth::user()->isSuperAdmin())
            return view('admin.pages.contact.index',[
                'contacts' => Contact::filter($request->all())->paginate(10)
            ]);
        else 
            abort(404);
    }

    public function index()
    {
        return view('contact');
    }

    public function modify(ContactRequest $request)
    {
        Contact::upsertInstance($request);

        return redirect()->route('contact');
    }
}