<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 128);
            $table->string('slug', 128);
            $table->string('short_description', 256);
            $table->text('content');
            $table->timestamp('published_at');
            $table->unsignedBigInteger('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('media_id')->references('id')->on('media');
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
        Schema::dropIfExists('articles');
    }
}
