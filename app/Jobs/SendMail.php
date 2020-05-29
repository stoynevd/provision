<?php

namespace App\Jobs;

use App\Mail\CreateNotification;
use App\ToDo;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendMail
 * @package App\Jobs
 * The jobs is used to send emails to the users at a creation of a new To Do task
 */

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $todo;

    public function __construct(ToDo $todo) {
        $this->todo = $todo;
    }

    public function handle() {
        try {

            $user = User::find($this->todo->user_id);

            Mail::to($user->email)->send(new CreateNotification($this->todo->title, $this->todo->date, $this->todo->time));
        } catch (\Exception $e) {
            \Log::error('[' . __CLASS__ . ' --> ' . __FUNCTION__ . ']: ' . $e->getMessage());
        }
    }
}
