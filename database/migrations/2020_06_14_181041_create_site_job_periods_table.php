<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteJobPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_job_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->references('id')->on('sites');
            $table->string('job');
            $table->string('period');
            $table->index(['job','site_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_job_periods');
    }
}
