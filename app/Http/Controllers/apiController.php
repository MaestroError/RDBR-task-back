<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Country;
use App\Models\Statistic;

class apiController extends Controller
{
    public function All() {
        $countries = Country::with("statistic")->get();
        return response($countries, 200);
    }
    public function Sum() {
        $stats = Statistic::with("country")->get()->keyBy('country.code');
        return response($stats, 200);
    }
}
