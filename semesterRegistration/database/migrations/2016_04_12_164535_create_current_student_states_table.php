<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCurrentStudentStatesTable, this class
 * creates the currentStudentStates database table
 */
class CreateCurrentStudentStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currentStudentStates', function (Blueprint $table)
        {
            $table->string('rollNo', '20');
            $table->smallInteger('semNo');
            $table->boolean('hostler');
            $table->boolean('feeReceipt');
            $table->timestamps();

            // Key constraints
            $table->primary('rollNo');
            $table->foreign('rollNo')
                ->references('rollNo')
                ->on('students')
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
        Schema::drop('currentStudentStates');
    }
}
