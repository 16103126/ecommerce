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
            $table->string('slug');
            $table->integer('category_id')->unsigned();
            $table->integer('subcategory_id')->nullable();
            $table->integer('childcategory_id')->nullable();
            $table->integer('quantity');
            $table->decimal('orginal_price');
            $table->decimal('selling_price');
            $table->string('image');
            $table->text('details');
            $table->text('small_details');
            $table->decimal('tax');
            $table->string('status')->default(1);
            $table->tinyInteger('trending')->default(1);
            $table->integer('views')->unsigned()->default(0);
            $table->string('tag');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keywords');
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
