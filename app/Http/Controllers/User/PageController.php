<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use const http\Client\Curl\AUTH_ANY;

class PageController extends Controller {

    public function showDashboard() {
        return view('user/dashboard')->with(['name' => Auth::user()->name, 'tasks' => Auth::user()->todos]);
    }

    public function showTask($id) {
        $todo = Auth::user()->todos()->find($id);
        if (!$todo) {
            return redirect('/user/dashboard');
        }

        $date = Carbon::parse($todo->datetime)->format('Y-m-d');
        $time = Carbon::parse($todo->datetime)->format('H:m');

        return view('user/todo')->with(['id' => $todo->id, 'title' => $todo->title, 'date' => $date, 'time' => $time]);
    }

}
