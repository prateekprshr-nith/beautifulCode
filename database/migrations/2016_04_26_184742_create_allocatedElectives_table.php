<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAllocatedElectivesTable, this class
 * creates allocatedElectives database table
 */
class CreateAllocatedElectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocatedElectives', function (Blueprint $table)
        {
            $table->string('rollNo', '20');
            $table->string('courseCode', '10');
            $table->timestamps();

            // Key constraints
            $table->primary(['rollNo', 'courseCode']);
            $table->foreign('rollNo')
                ->references('rollNo')
                ->on('students')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('courseCode')
                ->references('courseCode')
                ->on('courses')
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
        Schema::drop('allocatedElectives');
    }
}
