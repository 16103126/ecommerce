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
            $table->string('name');
            $table->string('email');
            $table->integer('phone_no');
            $table->integer('user_id');
            $table->integer('transaction_id');
            $table->integer('payment_id');
            $table->string('shipping_address');
            $table->string('country');
            $table->string('state');
            $table->string('zipecode');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('payment_status')->default(0);
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
