<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agency;
use Illuminate\Support\Str;

class AgencySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Agency::truncate();

        $agencies = [
            ['id' => 1,
            'uid' => Str::uuid(),
            'agency_name' => 'Excelation',
            ],
        ];

        foreach ($agencies as $key => $value) {
            $agency = new Agency();
            $agency->fill($value);
            $agency->save();
        }
    }
}
