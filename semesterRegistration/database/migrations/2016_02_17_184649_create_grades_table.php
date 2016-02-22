<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateGradesTable, this migration
 * creates the 'grades' talbe in databse
 */
class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table)
        {
            $table->string('rollNo');
            $table->decimal('sem1', '4', '2')->unsigned();
            $table->decimal('sem2', '4', '2')->unsigned();
            $table->decimal('sem3', '4', '2')->unsigned();
            $table->decimal('sem4', '4', '2')->unsigned();
            $table->decimal('sem5', '4', '2')->unsigned();
            $table->decimal('sem6', '4', '2')->unsigned();
            $table->decimal('sem7', '4', '2')->unsigned();
            $table->decimal('sem8', '4', '2')->unsigned();
            $table->decimal('sem9', '4', '2')->unsigned();
            $table->decimal('sem10', '4', '2')->unsigned();
            $table->decimal('sgpi', '4', '2')->unsigned();
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
        Schema::drop('grades');
    }
}
