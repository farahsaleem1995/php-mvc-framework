<?php


namespace App\Controllers;


use App\Core\Request;
use App\Core\Response;

class HomeController
{
    public function show(Request $request, Response $response)
    {
        return $response->render('home', [
            'name' => 'Farah'
        ]);
    }
}