<?php

namespace App\Jobs;

use App\Mail\CreateNotification;
use App\Mail\UpdateNotification;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendUpdateNotification
 * @package App\Jobs
 * This job sends an email to the user every time he/she updates a To Do task
 */

class SendUpdateNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $todo;

    public function __construct($todo) {
        $this->todo = $todo;
    }

    public function handle() {

        try {

            $user = User::find($this->todo->user_id);

            Mail::to($user->email)->send(new UpdateNotification($this->todo->title, $this->todo->date, $this->todo->time));
        } catch (\Exception $e) {
            \Log::error('[' . __CLASS__ . ' --> ' . __FUNCTION__ . ']: ' . $e->getMessage());
        }


    }
}
