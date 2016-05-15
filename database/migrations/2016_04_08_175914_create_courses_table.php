<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCoursesTable, this class
 * creates a courses database table
 */
class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table)
        {
            $table->string('courseCode', '10');
            $table->string('courseName', '50');
            $table->string('dCode', '10');
            $table->smallInteger('semNo');
            $table->boolean('openElective');
            $table->boolean('departmentElective');
            $table->smallInteger('lectures');
            $table->smallInteger('tutorials');
            $table->smallInteger('practicals');
            $table->smallInteger('credits');
            $table->timestamps();

            // Key constraints
            $table->primary('courseCode');
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('courses');
    }
}
