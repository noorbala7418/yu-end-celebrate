<?php

namespace Database\Seeders;

use App\Models\Fee;
use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fee::query()->truncate();

        Fee::create([
            'product' => 'ناهار - جوجه کباب',
            'type' => Fee::TYPE_FOOD,
            'unit' => 'پرس',
            'amount' => '35000'
        ]);

        Fee::create([
            'product' => 'تندیس',
            'type' => Fee::TYPE_GIFT,
            'unit' => 'عدد',
            'amount' => '50000'
        ]);

        Fee::create([
            'product' => 'شام - جوجه کباب',
            'type' => Fee::TYPE_FOOD,
            'unit' => 'پرس',
            'amount' => '35000'
        ]);

        Fee::create([
            'product' => 'UNi1400YZD',
            'type' => Fee::TYPE_CODE,
            'unit' => 'عدد',
            'amount' => '0'
        ]);
    }
}
