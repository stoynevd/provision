<?php

namespace App\Services;

use App\ToDo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TodoService {

    public static function createToDo($data) {
        try {
            $date = Carbon::parse($data['date'] . $data['time']);

            if ($date->isPast() == 1) {
                return [
                    'success' => false,
                    'message' => 'The date and time cannot be in the past!'
                ];
            }

            ToDo::create([
                'user_id'     => Auth::user()->id,
                'title'       => $data['title'],
                'datetime'    => $date
            ]);

            return [
                'success' => true,
                'message' => 'You have successfully added a new to do task!'
            ];

        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            return [
                'success' => false,
                'message' => 'Something went wrong, please try again'
            ];
        }

    }

    public static function deleteTask($data) {

        try {

            if (!$todo = Auth::user()->todos()->find($data['todo_id'])) {
                return [
                    'success' => false,
                    'message' => 'This todo task does not exist'
                ];
            }

            $todo->delete();

            return [
                'success' => true,
                'message' => 'You have successfully deleted the to do task'
            ];

        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            return [
                'success' => false,
                'message' => 'Something went wrong, please try again later.'
            ];
        }

    }

}
