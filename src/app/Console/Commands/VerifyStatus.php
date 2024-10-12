<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Lecon;
use App\Enums\StatutEnum;
use App\Services\LessonService;
use Illuminate\Console\Command;

class VerifyStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:verify-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify status of applications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $leconService = new LessonService();

        $lecons = Lecon::where('statut_id', StatutEnum::ATTENTE->value)->get();
        foreach ($lecons as $lecon) {
            if ((Carbon::today()->addDays(4) > Carbon::parse($lecon->date_reservation) && $lecon->essais == 0)
                || (Carbon::today()->addDays(2) > Carbon::parse($lecon->updated_at) && $lecon->essais == 1)) {
                $leconService->deny($lecon);
            }
        }
    }
}
