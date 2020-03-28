<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLunchUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunch_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lunch_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('lunch_id', 'index_lunch_user_lunch_id')
                ->references('id')
                ->on('lunches')
                ->onDelete('cascade');

            $table->foreign('user_id', 'index_lunch_user_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lunch_user');
    }
}
