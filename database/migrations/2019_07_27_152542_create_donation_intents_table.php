<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationIntentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_intents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 32);
            $table->unsignedInteger('amount');
            $table->string('email', 64);
            $table->unsignedBigInteger('donation_id')->references('id')->on('donations')->nullable(); //only get value when the transaction is confirmed
            $table->unsignedBigInteger('user_id')->references('id')->on('users')->nullable(); //only get value when the transaction is confirmed
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
        Schema::dropIfExists('donations_intents');
    }
}
