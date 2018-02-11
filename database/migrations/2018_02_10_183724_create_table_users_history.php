<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsersHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('platform')->nullable();
            $table->string('platform_version')->nullable();
            $table->string('browser')->nullable();
            $table->string('browser_version')->nullable();
            $table->ipAddress('address');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_history');
    }
}
