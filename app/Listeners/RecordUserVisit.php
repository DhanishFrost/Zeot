<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Models\UserVisit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RecordUserVisit
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserLoggedIn $event)
    {
        $user = $event->user;
        UserVisit::create([
            'user_id' => $user->id,
            'number_of_visits' => 1,
            'visited_at' => now(),
        ]);
    }
}
