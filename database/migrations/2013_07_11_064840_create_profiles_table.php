<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['CF', 'CC', 'JC', 'trainer']);
            $table->string('firstname');
            $table->string('lastname');
            $table->text('description');
            $table->string('CC');
            $table->string('JC');
            $table->string('trainer');
            // $table->string('challenge');
            // $table->string('hobby');
            $table->enum('status',['no-delegated', 'delegated', 'square', 'in recruitment process']);
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
        Schema::dropIfExists('profiles');
    }
}
