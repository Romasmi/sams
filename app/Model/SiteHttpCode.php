<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SiteHttpCode extends Model
{
    protected $fillable = [
        'http_code', 'site_id'
    ];

}
