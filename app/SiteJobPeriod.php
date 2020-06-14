<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteJobPeriod extends Model
{
    protected $fillable = [
        'site_id', 'job', 'period'
    ];

}
