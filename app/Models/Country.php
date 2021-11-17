<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Statistic;

class Country extends Model
{
    use HasFactory;

    public function statistic()
    {
        return $this->hasOne(Statistic::class);
    }
}
