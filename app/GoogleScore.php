<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleScore extends Model
{
    protected $fillable = [
        'site_id', 'strategy', 'page', 'score', 'data'
    ];

}
