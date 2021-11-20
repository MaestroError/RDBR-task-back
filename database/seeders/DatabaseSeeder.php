<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;
use App\Models\Statistic;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "maestroerror",
            'email' => "revaz.gh@gmail.com",
            'password' => bcrypt('password'),
        ]);
        artisan::call("get:countries");
    }
}
