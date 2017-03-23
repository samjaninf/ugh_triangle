<?php
namespace App\Http\Controllers;


use App\Http\Requests\RegistrationRequest;
use App\Repos\UserRepository;

class RegistrationController extends Controller
{

    private $repo;

    public function __construct()
    {
        $this->repo = new UserRepository();
    }

    public function register()
    {
        return view('home.sign_up');
    }

    public function doRegister(RegistrationRequest $request)
    {
        $this->repo->create($request);
        return $this->repo->getResponse();
    }

}