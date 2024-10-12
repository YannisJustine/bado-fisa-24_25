<?php

namespace App\Listeners;

use App\Events\EventAsked;
use App\Notifications\EventAskedNotif;
use App\Notifications\EventUpdatedNotif;

class SendEventAskedNotif
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
    public function handle(EventAsked $event): void
    {
        $lecon = $event->lecon;
        $formateur = $lecon->formateur;
        $formateur->notify(new EventAskedNotif($lecon));
        $candidat = $lecon->candidat;
        $candidat->notify(new EventUpdatedNotif($lecon));
    }
}
