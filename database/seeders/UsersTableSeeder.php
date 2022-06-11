<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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
                'name' => 'Admin Admin',
                'email' => 'admin@gmail.com',
                'role' => "admin",
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'User 001',
                'email' => 'user@gmail.com',
                'role' => "user",
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Super User',
                'email' => 'superuser@gmail.com',
                'role' => "su",
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now()
            ]
            ];

     
        DB::table('users')->insert($data);
    }
}
