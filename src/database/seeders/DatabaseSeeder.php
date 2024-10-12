<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TypePermis;
use DateTime;
use Illuminate\Database\Seeder;
use Database\Seeders\StatutSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::enableQueryLog();

        $this->call(StatutSeeder::class);
        $this->call(TypePermisSeeder::class);
        $this->call(FormuleSeeder::class);
        $this->call(FormuleConduiteSeeder::class);
        $this->call(FormuleCodeSeeder::class);
        $this->call(CreneauSeeder::class);

        \App\Models\User::factory(3)->create();
        \App\Models\Candidat::factory(10)->create();
        \App\Models\Vehicule::factory(10)->create();

        $this->call(HoraireFormateurSeeder::class, false, ['number' => 100]);
        $this->call(HabilitationSeeder::class);

        //\App\Models\Vehicule::factory(5)->create();

        $queries = DB::getQueryLog();
        foreach ($queries as $query) {
            $sql = $query['query'];
            $bindings = $query['bindings'];

            foreach ($bindings as &$binding) {
                if ($binding instanceof DateTime) {
                    $binding = $binding->format('Y-m-d H:i:s');
                }
            }

            $sqlWithBindings = vsprintf(str_replace('?', "'%s'", $sql), $bindings);

            Log::debug($sqlWithBindings);
        }
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}