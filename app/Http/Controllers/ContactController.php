<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.Contact.index',[
                'Contacts' => Contact::filter($request->all())->paginate(10),
        
            ]);
        else 
            abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upsert(Contact $Contact)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.Contact.upsert',[
                'Contact' => $Contact,
            ]);
        else 
            abort(404);
    }

    public function modify(Request $request)
    {
        return Contact::upsertInstance($request);
    }

    public function destroy(Contact $Contact)
    {
        return $Contact->deleteInstance();
    }

    public function filter(Request $request)
    {
        if(Auth::user()->isSuperAdmin())
            return view('admin.pages.Contact.index',[
                'Contacts' => Contact::filter($request->all())->paginate(10)
            ]);
        else 
            abort(404);
    }
}
