<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('name');
            $table->string('category');
            $table->bigInteger('price')->unsigned();
            $table->integer('available')->unsigned()->default(1);
            $table->string('size')->nullable();
            $table->longText('about');
            $table->string('pot')->nullable();
            $table->string('softdelete')->nullable()->default(0);
            $table->string('image')->nullable();
            $table->string('district')->nullable();
            $table->string('distance')->nullable();
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
