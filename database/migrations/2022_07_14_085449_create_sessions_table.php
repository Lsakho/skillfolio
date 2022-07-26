<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
        /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {

            $table->unsignedBigInteger('training_id');
            $table->foreign('training_id')
            ->references('id')
            ->on('trainings')
            ->onDelete('cascade')
            ->onUpdate('restrict');


            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')
            ->references('id')
            ->on('profiles')
            ->onDelete('restrict')
            ->onUpdate('restrict');

            $table->integer('date')->nullable();
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
        Schema::dropIfExists('sessions');
    }
}
