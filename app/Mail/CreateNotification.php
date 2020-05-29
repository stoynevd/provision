<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $task_name;
    public $task_date;
    public $task_time;

    public function __construct($task_name, $task_date, $task_time) {
        $this->task_name = $task_name;
        $this->task_date = $task_date;
        $this->task_time = $task_time;
    }

    public function build() {
        return $this->from(['address' => 'stoynevd@aston.ac.uk', 'name' => 'Dimitar Stoynev'])
            ->view('emails.createnotification');
    }
}
