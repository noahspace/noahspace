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

    public function login()
    {
        return view('login', [
            'action' => 'login',
            'action_url' => site_url('account/login'),
        ]);
    }

    public function register()
    {
        return view('login', [
            'action' => 'register',
            'action_url' => site_url('account/register'),
        ]);
    }
}
