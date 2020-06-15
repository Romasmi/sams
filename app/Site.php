<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SiteJobPeriod;

class Site extends Model
{
    protected $fillable = [
        'name', 'domain', 'protocol'
    ];

    public function getUrl()
    {
        return "{$this->protocol}://{$this->domain}";
    }

    public function jobPeriods()
    {
        return $this->hasMany('App\SiteJobPeriod');
    }

    public function lastHttpCode()
    {
        return $this->hasMany('App\SiteHttpCode')->latest()->first();
    }
}
