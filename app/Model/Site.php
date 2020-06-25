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

    public function lastGoogleScore($page = '/')
    {
        $result = new \stdClass();
        $result->mobile = $this->hasMany('App\Model\GoogleScore')
            ->where([
                'strategy' => 'mobile',
                'page' => $page,
            ])
            ->latest()->first();
        $result->desktop = $this->hasMany('App\Model\GoogleScore')
            ->where([
                'strategy' => 'desktop',
                'page' => $page,
            ])
            ->latest()->first();
        $result->updatedAt = null;

        if ($result->mobile) {
            $result->updatedAt = $result->mobile->updated_at;
        } elseif ($result->desktop) {
            $result->updatedAt = $result->desktop->updated_at;
        }

        return $result;
    }

    public function pages()
    {
        return $this->hasMany('App\Model\Page');
    }

    public function metricsOnUpdating()
    {
        $metricFullUpdate = $this->hasMany('App\Model\MetricsFullUpdate')
            ->latest()->first();
        return $metricFullUpdate && $metricFullUpdate->created_at == $metricFullUpdate->updated_at;
    }
}
