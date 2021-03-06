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
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('root')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('retail_price');
            $table->string('wholesale_price')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('image')->nullable();
            $table->string('quantity');

            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('categories');
            
            $table->unsignedBigInteger('supplier_id')->index();
            $table->foreign('supplier_id')->references('id')->on('suppliers');

            
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
