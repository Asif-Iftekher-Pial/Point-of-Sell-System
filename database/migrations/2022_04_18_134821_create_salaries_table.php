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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('employee_name');
            $table->string('salaryAmount');
            $table->enum('paymentStatus',['paid','due'])->default('due');
            $table->string('bonus')->default('not paid')->nullable();
            $table->string('date')->default('not paid')->nullable();
            $table->string('month')->default('not paid')->nullable();
            $table->string('year')->default('not paid')->nullable();
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
        Schema::dropIfExists('salaries');
    }
};
