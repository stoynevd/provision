<?php

namespace App\Jobs;

use App\Mail\ComingNotification;
use App\ToDo;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {
        //
    }

    public function handle() {

        try {

            foreach (ToDo::all() as $todo) {

                $date = Carbon::parse($todo->datetime);

                if ($date->isPast() != 1
                    && Carbon::now()->diffInMinutes(Carbon::parse($todo->datetime)) <= 5) {

                    Mail::to($todo->user->email)->send(new ComingNotification($todo->title));

                }

            }

        } catch (\Exception $e) {
            \Log::error('[' . __CLASS__ . ' --> ' . __FUNCTION__ . ']: ' . $e->getMessage());
        }
    }
}
