<?php

namespace App\Http\Controllers;

class TOSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = site_option('tos');
        return view('home.tos', compact('content'));
    }

}
