<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use const http\Client\Curl\AUTH_ANY;

class PageController extends Controller {

    public function showDashboard() {
        return view('user/dashboard')->with(['name' => Auth::user()->name]);
    }

}
