<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home', [
            'logged_in' => $this->session->get('logged_in'),
            'user' => $this->session->get('user'),
        ]);
    }
}
