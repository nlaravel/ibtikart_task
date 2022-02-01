<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->string("image")->nullable()->comment = "image";
			$table->string("title")->nullable()->comment = "title";
			$table->double("price")->nullable()->comment = "price";
			$table->longText("description")->nullable()->comment = "description";
            $table->unsignedBigInteger("type_id")->nullable();
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}