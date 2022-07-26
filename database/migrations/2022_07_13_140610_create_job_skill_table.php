<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_jobs', function (Blueprint $table) {
            
            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')
                ->references('id')
                ->on('jobs')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->unsignedBigInteger('skill_id');
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
        Schema::dropIfExists('job_skill');
    }
}
