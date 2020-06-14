<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteJobPeriod extends Model
{
    protected $fillable = [
        'site_id', 'job', 'period'
    ];

    public const periods = [
        [
            'value' => 'hour',
            'name' => 'Каждый час'
        ],
        [
            'value' => 'day',
            'name' => 'Каждый день'
        ],
        [
            'value' => 'week',
            'name' => 'Раз в неделю'
        ],
        [
            'value' => 'month',
            'name' => 'Раз в месяц'
        ],
        [
            'value' => 'never',
            'name' => 'Никогда'
        ],
    ];

}
