<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ActionController extends Controller {

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

}
