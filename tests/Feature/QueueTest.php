<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Model\Site;
use App\Jobs;
use App\Services;

class QueueTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public  function testQueueEvent()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
