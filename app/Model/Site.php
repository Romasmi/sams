<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\SiteJobPeriod;

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
        return $this->hasMany('App\Model\SiteJobPeriod');
    }

    public function lastHttpCode()
    {
        return $this->hasMany('App\Model\SiteHttpCode')->latest()->first();
    }

    public function pages()
    {
        return $this->hasMany('App\Model\Page');
    }
}
