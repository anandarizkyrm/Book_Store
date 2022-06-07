<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
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
                'name' => 'Book 001',
                'slug' => 'book-001',
                'summary'=> 'Summary of Book 001',
                'description' => 'Description of Book 001',
                'image' => 'book-001.jpg',
                'status' => 'active',
                'price' => '100000',
                'category_id' => 1,
                'writer_id' => 1,
                'publisher_id' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Book 002',
                'slug' => 'book-002',
                'summary'=> 'Summary of Book 002',
                'description' => 'Description of Book 002',
                'image' => 'book-002.jpg',
                'status' => 'active',
                'price' => '100000',
                'category_id' => 2,
                'writer_id' => 2,
                'publisher_id' => 2,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Book 002',
                'slug' => 'book-003',
                'summary'=> 'Summary of Book 002',
                'description' => 'Description of Book 002',
                'image' => 'book-002.jpg',
                'status' => 'active',
                'price' => '100000',
                'category_id' => 1,
                'writer_id' => 2,
                'publisher_id' => 2,
                'created_at' => now(),
                'updated_at' => now()

            ]
            ];
            

        DB::table('books')->insert($data);
    }
}
