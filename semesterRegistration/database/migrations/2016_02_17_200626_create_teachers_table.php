<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTeachersTable, this migration
 * creates the 'teachers' table in databse
 */
class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table)
        {
            $table->string('facultyId', '20');
            $table->string('name', '100');
            $table->string('email', '50');
            $table->string('dCode', '10');
            $table->string('office', '50');
            $table->smallInteger('semester')->nullable();   // The semester given to teacher
            $table->string('password', '100');
            $table->boolean('firstLogin');
            $table->rememberToken();
            $table->timestamps();

            // Key constraints
            $table->primary('facultyId');
            $table->unique('email');
            $table->unique('semester');
            $table->foreign('dCode')
                ->references('dCode')
                ->on('departments')
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
        Schema::drop('teachers');
    }
}
