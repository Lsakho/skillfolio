<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('skill_id');
            $table->unique(['profile_id', 'skill_id']);
            $table->integer('nb_stars')->nullable();

            $table->foreign('profile_id')
                    ->references('id')
                    ->on('profiles')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('skill_id')
            ->references('id')
            ->on('skills')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
