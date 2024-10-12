<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Enums\StatutEnum;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\EventService;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventCollection;

class UserEventController extends Controller
{
    private $eventService;
    private $userService;

    public function __construct(EventService $eventService, UserService $userService)
    {
        $this->eventService = $eventService;
        $this->userService = $userService;
    }

    public function show(User $user, Request $request)
    {
        $lecons = $this->eventService->getAllEvents([
            ["user_id", $user->id],
            ["statut_id", '<>', StatutEnum::REFUSE->value],
            ["statut_id", '<>', StatutEnum::IMPOSSIBLE->value],
            ["date_reservation", '>=', $request->start],
            ["date_reservation", '<=', $request->end]
        ]);

        return new EventCollection($lecons);
    }
}
