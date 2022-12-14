<?php

namespace App\Listeners;

use App\Mail\WelcomeContestMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeContestEntryNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //dd($event->ContestEntry->email);
        Mail::to($event->ContestEntry->email)
            ->send(new WelcomeContestMail());
    }
}
