<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_media', function (Blueprint $table) {
            $table->foreignId('activity_id')->references('id')->on('activities');
            $table->foreignId('media_id')->references('id')->on('media');
            $table->primary(['activity_id', 'media_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_media');
    }
}
