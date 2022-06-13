<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'type' => 'Banjarmasin Utara',
                'price' => '10000',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'type' => 'Banjarmasin Barat',
                'price' => '12000',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'type' => 'Banjarmasin Selatan',
                'price' => '13000',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'type' => 'Banjarmasin Timur',
                'price' => '14000',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'type' => 'Banjarmasin Tengah',
                'price' => '15000',
                'created_at' => now(),
                'updated_at' => now()

            ],
         
            ];
            

        DB::table('shipping')->insert($data);
    }
}
