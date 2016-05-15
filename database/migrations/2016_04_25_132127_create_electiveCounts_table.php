<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateElectiveCountsTable, this class
 * creates electiveCounts database table
 */
class CreateElectiveCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electiveCounts', function (Blueprint $table)
        {
            $table->string('dCode', '10');
            $table->smallInteger('semNo');
            $table->smallInteger('openElectives');
            $table->smallInteger('departmentElectives');
            $table->timestamps();

            // Key constrations
            $table->primary(['dCode', 'semNo']);
            $table->foreign('dCode')
                ->references('dCode')
                ->on('departments')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('semNo')
                ->references('semNo')
                ->on('semesters')
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
        Schema::drop('electiveCounts');
    }
}
