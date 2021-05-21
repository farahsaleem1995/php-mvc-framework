<?php


namespace App\Controllers;


use App\Core\Request;
use App\Core\Response;

class AuthController
{
    public function showLogin(Request $request, Response $response)
    {
        return $response->render('login');
    }

    public function login(Request $request, Response $response)
    {
        return $response->content('Login submitted');
    }

    public function showRegister(Request $request, Response $response)
    {
        return $response->render('register');
    }

    public function register(Request $request, Response $response)
    {
        return $response->content('Register submitted');
    }
}