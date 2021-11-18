<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Country;
use App\Models\Statistic;
use Illuminate\Support\Facades\Http;

use Carbon\Carbon;

class getStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:statistics {--nobar}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Fetch's statistics for countries";

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
        $countries = Country::with("statistic")->get();

        // get progressbar ready
        if(!$this->option('nobar')) {
            $bar = $this->output->createProgressBar(count($countries));
            $bar->start();
        }
        
        
        foreach ($countries as $country) {
            // get statistic
            $stat = Http::withHeaders([
                'accept' => 'application/json'
            ])->post("https://devtest.ge/get-country-statistics", [
                "code" => $country->code
            ])->json();
            
            // check if statistic exists
            if ($country->statistic === null) {
                $this->createNew($country, $stat);
            } else {
                if($country->statistic->created_at->format('d-m') == Carbon::today()->format('d-m')) {
                    $this->updateOne($country, $stat);
                } else {
                    $this->createNew($country, $stat);
                }
                if(isset($stat['message'])) {
                    $this->info(json_encode($stat));
                    $this->newLine();
                    $this->info("Some Error occurred: ".$stat['message']);
                    exit;
                }
                
            }
            if(!$this->option('nobar')) {
                $bar->advance();
            }
        }

        // finish of command
        if(!$this->option('nobar')) {
            $bar->finish();
            $this->newLine();
        }
        $this->info('Statistics fetched successfully!');

    }

    // create new record
    protected function createNew($country, $stat) {
        $Statistic = new Statistic($stat);
        $country->statistic()->save($Statistic);
    }

    // update existing
    protected function updateOne($country, $stat) {
        $country->statistic->fill($stat)->save();
    }

}
