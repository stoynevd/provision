<?php

namespace App\Http\Controllers\Guest;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionController extends Controller {

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'          =>  'bail|required',
            'email'         =>  'bail|required|email',
            'password'      =>  'bail|required|confirmed',
        ]);
        if($validator->fails()) {
            return $this->returnCustomJsonValidatorError($validator);
        }
        $user = User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => bcrypt($request->input('password')),
        ]);
        Auth::loginUsingId($user->id);
        return response()->json(['success' => true]);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'         => 'bail|required|email',
            'password'      => 'bail|required|min:6|max:32',
        ]);
        if($validator->fails()) {
            return $this->returnCustomJsonValidatorError($validator);
        }
        $userDetails = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password')
        ];
        if(Auth::attempt($userDetails)) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }


}
