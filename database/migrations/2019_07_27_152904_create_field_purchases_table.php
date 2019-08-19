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
            $table->unsignedTinyInteger('row');
            $table->unsignedTinyInteger('column');
            $table->char('letter', 1);
            $table->char('color', 7)->default('#000000');
            $table->unsignedBigInteger('field_purchaser_id')->references('id')->on('field_purchasers');
            $table->timestamps();

            $table->unique(['row', 'column']);
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
