<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Statistic;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name'
    ];

    protected $casts = [
        "name" => 'array',
    ];

    public function setNameAttribute($value)
	{
	    $this->attributes['name'] = json_encode($value);
	}

    public function statistic()
    {
        return $this->hasOne(Statistic::class);
    }
}
