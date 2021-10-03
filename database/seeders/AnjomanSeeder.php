<?php

namespace Database\Seeders;

use App\Models\Anjoman;
use Illuminate\Database\Seeder;

class AnjomanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Anjoman::query()->truncate();

        Anjoman::query()->create([
            'name' => 'مهندسی کامپیوتر'
        ]);

        Anjoman::query()->create([
            'name' => 'مهندسی نساجی'
        ]);

        Anjoman::query()->create([
            'name' => 'علوم کامپیوتر'
        ]);

        Anjoman::query()->create([
            'name' => 'مهندسی صنایع'
        ]);

        Anjoman::query()->create([
            'name' => 'مهندسی معدن'
        ]);
    }
}
