<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
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
                "name" => "Pt Suka Menulis",
                "email" => "sukamenulis@gmail.com",
                "address" => "Jl. Raya Cibaduyut No.1, Cibaduyut, Kec. Cibaduyut, Kabupaten Bandung Barat, Jawa Barat 40391",
            ],
            [
                "name" => "Bentang Pustaka",
                "email" => "bentangpustaka@any.com",
                "address" => "Jl. Raya Cibaduyut No.1, Cibaduyut, Kec. Cibaduyut, Kabupaten Bandung Barat, Jawa Barat 40391",
            ],
            [
                "name" => "ABC Pustaka",
                "email" => "abcpustaka@any.com",
                "address" => "Jl. Raya Cibaduyut No.1, Cibaduyut, Kec. Cibaduyut, Kabupaten Bandung Barat, Jawa Barat 40391",
            ],
            [
                "name" => "Muda Pustaka",
                "email" => "mudapustaka@any.com",
                "address" => "Jl. Raya Cibaduyut No.1, Cibaduyut, Kec. Cibaduyut, Kabupaten Bandung Barat, Jawa Barat 40391",
            ]

            ];

        DB::table('publishers')->insert($data);
    }
}
