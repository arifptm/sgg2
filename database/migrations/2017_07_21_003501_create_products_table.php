<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name', 127);
            $table->string('slug', 127);
            $table->enum('status',['pending','approved','rejected'])->default('pending');
            $table->text('body')->nullable();
            $table->string('image', 127)->nullable();
            $table->string('price',15)->nullable();
            $table->string('url', 127)->nullable();
            $table->string('unit', 31);
            $table->enum('disposable',['hp','unhp'])->nullable();
            $table->integer('stock')->default(0);
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
        Schema::drop('products');
    }
}
