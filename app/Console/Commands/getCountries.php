<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Country;
use Illuminate\Support\Facades\Http;
use DB;

class getCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Fetch's all countries from Covid Statistics API";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // get response
        $response = Http::withHeaders([
            'accept' => 'application/json'
        ])->get("https://devtest.ge/countries");
        
        // delete records
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Country::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // create countries
        foreach ($response->json() as $country) {
            Country::create($country);
        }

        $this->info("Countries populated successfully");
    }
}
