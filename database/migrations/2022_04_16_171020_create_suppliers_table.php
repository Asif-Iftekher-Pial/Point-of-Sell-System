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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->string('email')->unique();
            $table->integer('phone');
            $table->longText('address');
            $table->enum('type',['wholeSale','retailer'])->default('retailer');
            $table->string('image');
            $table->string('shop');
            $table->string('accountHolder')->nullable();
            $table->string('accountNumber')->nullable();
            $table->string('bankName')->nullable();
            $table->string('branchName')->nullable();
            $table->string('city');
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
        Schema::dropIfExists('suppliers');
    }
};
