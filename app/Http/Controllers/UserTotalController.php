<?php

namespace App\Http\Controllers;

use App\Models\UserTotal;
use Illuminate\Http\Request;

class UserTotalController extends Controller
{
    public function enterResult(Request $request)
    {
        return UserTotal::enterResult($request);
    }
}
