<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                "name" => "Horror",
                "slug" => "horror",
            ],
            [
                "name" => "Romance",
                "slug" => "romance",

            ],
            [
                "name" => "Fantasy",
                "slug" => "fantasy",
            ],
            [
                "name" => "Science Fiction",
                "slug" => "science-fiction",
            ],
            [
                "name"=> "Mystery",
                "slug" => "mystery",

            ]

            ];

        DB::table('category')->insert($data);
    }
}
