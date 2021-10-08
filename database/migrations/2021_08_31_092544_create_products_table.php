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
            $table->uuid('uuid');
            $table->string('sku')->nullable();
            $table->text('product');
            $table->text('slug');
            $table->longText('descriptions')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null')->onUpdate('cascade');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null')->onUpdate('cascade');
            $table->double('price', 8, 2)->default(0.00);
            $table->double('discount', 8, 2)->default(0.00);
            $table->enum('discount_type', ['flat', 'percent'])->nullable();
            $table->integer('unit')->default(1);
            $table->string('thumbnail')->nullable();
            $table->string('alt')->nullable();
            $table->boolean('publish')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->softDeletesTz('deleted_at', 0);
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
