<?php
namespace App\Http\Controllers\App;


use App\Http\Controllers\Controller;

class MessagesController extends Controller
{

    public function index()
    {
        return view('app.messages.index');
    }

}