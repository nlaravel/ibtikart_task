<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->double("total")->nullable();
            $table->unsignedBigInteger("product_id")->nullable();
            $table->unsignedBigInteger("color_product_id")->nullable();
            $table->unsignedBigInteger("size_product_id")->nullable();
            $table->unsignedBigInteger("amount_product_id")->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('color_product_id')->references('id')->on('')->onDelete('cascade');
            $table->foreign('size_product_id')->references('id')->on('size_products')->onDelete('cascade');
            $table->foreign('amount_product_id')->references('id')->on('amount_products')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
