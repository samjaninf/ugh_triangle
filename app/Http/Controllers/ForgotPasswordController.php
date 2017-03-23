<?php
namespace App\Http\Controllers;


use App\Repos\UserRepository;

class ForgotPasswordController extends Controller
{
    private $repo;

    public function __construct()
    {
        $this->repo = new UserRepository();
    }

    public function forgotPassword()
    {
        return view('home.forgot_password');
    }

    public function doForgotPassword()
    {
        $this->repo->forgotPassword();
        return $this->repo->getResponse();
    }
}