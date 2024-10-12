<?php

namespace App\Listeners;

use App\Events\EventUpdated;
use App\Notifications\EventUpdatedNotif;

class SendEventUpdatedNotif
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     */
    public function handle(EventUpdated $event): void
    {
        $lecon = $event->lecon;
        $candidat = $lecon->candidat;
        $candidat->notify(new EventUpdatedNotif($lecon));
    }
}
