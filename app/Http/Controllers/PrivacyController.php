<?php

namespace App\Http\Controllers;

class PrivacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = site_option('privacy');
        return view('home.privacy', compact('content'));
    }

}
