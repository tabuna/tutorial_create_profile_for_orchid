<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsForUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('city_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('city_id');
        });
    }
}
