<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->boolean('default')->default(0);
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('district_id')->constrained('districts')->cascadeOnDelete();
            $table->foreignId('ward_id')->constrained('wards')->cascadeOnDelete();
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
        Schema::dropIfExists('user_addresses');
    }
}
