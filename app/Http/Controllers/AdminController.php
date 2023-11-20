<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Preparator;
use App\Models\Setting;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        if(date('m/d/Y') == '6/1/2023'){
            User::where('role_id', 2)->update([
                'suspend' => 0
            ]);
        }

        return view('admin.pages.dashboard', [
            'setting'=>Setting::find(1),
            'subjects' => Subject::all(),
            'preparators' => Preparator::all(),
        ]);
    }
}
