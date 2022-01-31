<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone',10)->unique()->nullable();
            $table->integer('gender')->nullable();
            $table->boolean('is_merchant')->default(0);
            $table->boolean('is_shipper')->default(0);
            $table->date('date_of_birth')->nullable();
            $table->string('password')->nullable();
            $table->string('merchant_name')->nullable();
            $table->string('address')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('image')->nullable();
            $table->string('phone_plate')->nullable();
            $table->string('avatar')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
