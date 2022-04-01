<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

   /* public function __construct()
    {
        $this->middleware('auth');
    }*/
    public function about()
    {
        return view('about');
    }
}
