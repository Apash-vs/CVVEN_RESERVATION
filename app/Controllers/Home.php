<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message'); // Ou une vue personnalisée si tu veux
    }
}
