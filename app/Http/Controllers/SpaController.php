<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends Controller
{
//    function index(){
//        return view('home');
//    }
    function adminIndex(){
        return view('layouts.admin_layoutV2');
    }
}
