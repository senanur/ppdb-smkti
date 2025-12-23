<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomAuthController extends Controller
{
    //login custom
    public function login()
    {
        return view("auth.customLogin");
    }
}
