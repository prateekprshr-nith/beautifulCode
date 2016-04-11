N<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailableCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availableCourses', function (Blueprint $table)
        {
            $table->string('dCode', '10');
            $table->smallInteger('semNo');
            $table->string('courseCode', '10');
            $table->timestamps();

            // Key constraints
            $table->primary(['dCode', 'semNo', 'courseCode']);
            $table->foreign('dCode')
                ->references('dCode')
                ->on('departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('semNo')
                ->references('semNo')
                ->on('semesters')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('courseCode')
                ->references('courseCode')
                ->on('courses')
                ->onUpdate('cascade')
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
        Schema::drop('availableCourses');
    }
}
