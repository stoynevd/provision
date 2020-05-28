<?php

namespace App\Jobs;

use App\ToDo;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CleanToDos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {
        //
    }

    public function handle() {

        try {

            foreach (ToDo::all() as $todo) {

                $date = Carbon::parse($todo->datetime);

                if ($date->isPast() == 1) {

                    $todo->delete();

                }

            }
        } catch (\Exception $e) {
            \Log::error('[' . __CLASS__ . ' --> ' . __FUNCTION__ . ']: ' . $e->getMessage());
        }
    }
}
