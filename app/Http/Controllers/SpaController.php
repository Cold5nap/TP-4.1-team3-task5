<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/adm/home",
     *     tags={"adm_home"},
     *     summary="Returns admin layout",
     *     operationId="adminIndex",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     * )
     */
    function adminIndex(){
        return view('layouts.admin_layoutV2');
    }
    function index(){
        return view('layouts.layout');
    }
}
