<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Country;
use App\Models\Statistic;
use Illuminate\Support\Facades\Cache;

class apiController extends Controller
{
    public function All() {
        // cache for half hour
        if(Cache::has('All')) {
            $countries = Cache::get('All');
        } else {
            $countries = Country::with("statistic")->get();
            Cache::put('All', $countries, now()->addMinutes(30));
        }
        return response($countries, 200);
    }
    public function Sum() {
        if(Cache::has('Sum')) {
            $stats = Cache::get('Sum');
        } else {
            $stats = Statistic::with("country")->get()->keyBy('country.code');
            Cache::put('Sum', $stats, now()->addMinutes(30));
        }
        return response($stats, 200);
    }
}
