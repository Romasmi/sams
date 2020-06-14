<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'name', 'domain', 'protocol'
    ];

    public function getUrl()
    {
        return "{$this->protocol}://{$this->domain}";
    }
}
