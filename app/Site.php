<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $primaryKey = 'id_site';

    protected $fillable = [
        'name', 'url', 'parent_domain',
    ];

}
