<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Client::truncate();

        $clients = [
            ['id' => 1,
            'uid' => Str::uuid(),
            'agency_id' => 1,
            'client_name' => 'Virtual Central',
            ],
        ];

        foreach ($clients as $key => $value) {
            $client = new Client();
            $client->fill($value);
            $client->save();
        }
    }
}
