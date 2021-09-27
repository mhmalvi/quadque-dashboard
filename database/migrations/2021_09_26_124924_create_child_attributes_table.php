<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_attributes', function (Blueprint $table) {
            $table->id();

            $table->string('attribute');
            $table->string('info')->nullable();
            $table->unsignedBigInteger('attribute_id');
            $table->foreign('attribute_id')->references('id')
                ->on('attributes')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('child_attributes');
    }
}
