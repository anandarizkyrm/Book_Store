<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class WriterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data =[
        [
            'name' => 'Thomas Valley',
            'created_at' => now(),
            'updated_at' => now()

        ],
        [
            'name' => 'Barkley Imamo',
            'created_at' => now(),
            'updated_at' => now()

        ]
        ];

        DB::table('writer')->insert($data);
    }
}
