<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\TodoService;
use App\ToDo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActionController extends Controller {

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    public function addNewTask(Request $request) {
        $validator = Validator::make($request->all(), [
            'title'     =>  'bail|required',
            'date'      =>  'bail|required|date',
            'time'      =>  'bail|required',
        ]);
        if($validator->fails()) {
            return $this->returnCustomJsonValidatorError($validator);
        }

        $result = TodoService::createToDo($request->all());

        return response()->json($result);
    }

    public function deleteTask(Request $request) {
        $validator = Validator::make($request->all(), [
            'todo_id'     =>  'bail|required|integer',
        ]);
        if($validator->fails()) {
            return $this->returnCustomJsonValidatorError($validator);
        }

        $result = TodoService::deleteTask($request->all());

        return response()->json($result);

    }

}
