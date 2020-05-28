<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComingNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $task_name;

    public function __construct($task_name) {
        $this->task_name = $task_name;
    }

    public function build() {
        return $this->from(['address' => 'stoynevd@aston.ac.uk', 'name' => 'Dimitar Stoynev'])
            ->view('emails.comingnotification');
    }
}
