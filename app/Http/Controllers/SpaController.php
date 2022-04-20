<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends Controller
{
    function adminIndex(){
        return view('layouts.admin_layoutV2');
    }
    function index(){
        return view('layouts.layout');
    }
}
