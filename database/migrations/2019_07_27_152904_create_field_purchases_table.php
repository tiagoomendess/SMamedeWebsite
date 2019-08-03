<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('row');
            $table->integer('column');
            $table->integer('field_purchaser_id')->references('id')->on('field_purchasers');
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
        Schema::dropIfExists('field_purchases');
    }
}
