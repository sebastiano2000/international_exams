<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Financial_transaction;
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
            'financial'=> Financial_transaction::count(),
        ]);
    }

    public function exams()
    {
        return view('admin.pages.exams', [
            'subjects' => Subject::all(),
        ]);
    }

    public function preparators()
    {
        return view('admin.pages.preparators', [
            'preparators' => Preparator::all(),
        ]);
    }

    public function attachments()
    {
        return view('admin.pages.attachments', [
            'attachments' => Attachment::all(),
        ]);
    }
}
