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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->enum('status',['active','inactive'])->default('active');
            $table->string('CategoryName');
            $table->foreignId('child_cat_id')->constrained('child_categories')->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->string('product_code');
            $table->string('warehouse');
            $table->string('product_route');
            $table->string('image');
            $table->string('purchase_date');
            $table->string('expire_date');
            $table->string('buying_price');
            $table->string('selling_price');
            $table->integer('stock');
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
};
