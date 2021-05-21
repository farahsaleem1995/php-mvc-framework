<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;

class ContactController
{
    public function show(Request $request, Response $response)
    {
        return $response->render('contact');
    }

    public function store(Request $request, Response $response)
    {
        return 'Subject: ' . $request->body()['subject'] .
            '<br> Email: ' . $request->body()['email'] .
            '<br> Body: ' . $request->body()['body'];
    }
}