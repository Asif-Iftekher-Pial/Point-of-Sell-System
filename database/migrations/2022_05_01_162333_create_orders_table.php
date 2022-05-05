<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->integer('customer_id');
            $table->string('invoice_number');
            $table->string('order_number');
            $table->string('customer_name');
            $table->string('address');
            $table->string('phone');
            $table->enum('payment_status',['paid','partial'])->default('paid');
            $table->string('partial_paid')->default('no');
            $table->string('partial_amount')->default()->nullable();
            $table->string('due_amount')->nullable();
            $table->string('shop_name');
            $table->string('total_amount');
            $table->string('order_status')->default('confirmed');
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
};
