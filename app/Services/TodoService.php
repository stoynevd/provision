<?php

namespace App\Services;

use App\Jobs\SendMail;
use App\Jobs\SendUpdateNotification;
use App\Mail\CreateNotification;
use App\Mail\UpdateNotification;
use App\ToDo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

            $todo = ToDo::create([
                'user_id'     => Auth::user()->id,
                'title'       => $data['title'],
                'date'        => $data['date'],
                'time'        => $data['time']
            ]);

            dispatch(new SendMail($todo));

            return [
                'success' => true,
                'message' => 'You have successfully added a new to do task!'
            ];

        } catch (\Exception $e) {
            \Log::error('[' . __CLASS__ . ' --> ' . __FUNCTION__ . ']: ' . $e->getMessage());

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
            \Log::error('[' . __CLASS__ . ' --> ' . __FUNCTION__ . ']: ' . $e->getMessage());

            return [
                'success' => false,
                'message' => 'Something went wrong, please try again later.'
            ];
        }

    }

    public static function updateTask($data) {

        try {

            if (!$todo = Auth::user()->todos()->find($data['id'])) {
                return [
                    'success' => false,
                    'message' => 'Something went wrong, please try again.',
                ];
            }

            $date = Carbon::parse($data['date'] . $data['time']);

            if ($date->isPast() == 1) {
                return [
                    'success' => false,
                    'message' => 'The date and time cannot be in the past!'
                ];
            }

            $data = array_filter($data);

            $todo->fill([
                'title'    => isset($data['title']) ? $data['title'] : $todo->title,
                'date'     => $data['date'],
                'time'     => $data['time'],
            ]);

            $todo->save();

            dispatch(new SendUpdateNotification($todo));

            return [
                'success' => true,
                'message' => 'You have successfully edited the to do task',
            ];

        } catch (\Exception  $e) {
            \Log::error('[' . __CLASS__ . ' --> ' . __FUNCTION__ . ']: ' . $e->getMessage());

            return [
                'success' => false,
                'message' => 'Something went wrong, please try again.',
            ];
        }

    }

}
