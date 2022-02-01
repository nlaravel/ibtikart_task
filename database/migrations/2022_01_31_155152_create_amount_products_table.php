<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmountProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amount_products', function (Blueprint $table) {
            $table->id();
            $table->string("image")->nullable();
            $table->string("amount")->nullable();
            $table->longText("description")->nullable();
            $table->double("price")->nullable();
            $table->unsignedBigInteger("product_id")->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('amount_products');
    }
}
