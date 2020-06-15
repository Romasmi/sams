<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleScore extends Model
{
    public $data;

    protected $fillable = [
        'site_id', 'strategy', 'page', 'score'
    ];

}
