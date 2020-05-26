<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller {

    public function showRegister() {
        return view('guest/register');
    }

    public function showLogin() {
        return view('guest/login');
    }

}
