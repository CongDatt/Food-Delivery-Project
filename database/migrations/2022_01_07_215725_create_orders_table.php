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

            $table->string('shipper_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('merchant_id')->nullable();

            $table->string('address')->nullable();
            $table->string('address_note')->nullable();
            $table->string('total_bill')->nullable();
            $table->string('items')->nullable();
            $table->string('item_cost')->nullable();
            $table->integer('delivery_cost')->default(0);


//            $table->foreignId('shipper_id')->constrained('shippers')->cascadeOnDelete();
//            $table->foreignId('merchant_id')->constrained('merchants')->cascadeOnDelete();
//            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

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
