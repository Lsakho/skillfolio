<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Skill;
use App\Models\ProfileSkill;

class CreateProfileSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_skills', function (Blueprint $table) {
            
            

            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')
                  ->references('id')
                  ->on('profiles')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id')
                 ->references('id')
                  ->on('skills')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->enum('level', ['Mother Tongue','A1','A2','B1','B2','C1','C2'])->nullable();
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
        Schema::dropIfExists('profile_skills');
    }
}
