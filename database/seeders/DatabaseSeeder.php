<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([UsersTableSeeder::class]);
        $this->call([CategorySeeder::class]);
        $this->call([WriterSeeder::class]);
     
        // $this->call([CartSeeder::class]);
        $this->call([PublisherSeeder::class]);
        // $this->call([NotificationSeeder::class]);
        $this->call([ShippingSeeder::class]);
        // $this->call([OrderSeeder::class]);
        $this->call([UsersTableSeeder::class]);
        $this->call([ReviewSeeder::class]);
        $this->call([BookSeeder::class]);
    

    }
}
