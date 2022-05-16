<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvisingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advisings', function (Blueprint $table) {
            $table->id();
            $table->string('course_title')->nullable();
            $table->string('class_code')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->boolean('IsActive')->nullable();
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
        Schema::dropIfExists('advisings');
    }
}
