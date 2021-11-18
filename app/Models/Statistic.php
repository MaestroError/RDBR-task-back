<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Country;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'confirmed',
        'recovered',
        'deaths'
    ];



    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
