<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_scores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('site_id')->references('id')->on('sites');
            $table->string('strategy');
            $table->string('page');
            $table->unsignedFloat('score')->nullable();
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('google_score');
    }
}
