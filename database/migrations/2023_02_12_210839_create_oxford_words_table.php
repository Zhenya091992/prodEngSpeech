<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oxford_words', function (Blueprint $table) {
            $table->id();
            $table->tinyText('word');
            $table->tinyText('link');
            $table->tinyText('part');
            $table->tinyText('level');
            $table->text('us_mp3_href');
            $table->text('us_ogg_href');
            $table->text('br_mp3_href');
            $table->text('br_ogg_href');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oxford_words');
    }
};
