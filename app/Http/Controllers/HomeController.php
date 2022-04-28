<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        if (session('user_id')) {
            return view('loggeninpage');
        }
        return view('index');
    } //end of function body
}//en of class body