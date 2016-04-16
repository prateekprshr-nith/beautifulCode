<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateGradesTable, this migration
 * creates the 'grades' table in databse
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
            $table->smallInteger('semNo');
            $table->decimal('sgpi', '4', '2')->unsigned();
            $table->decimal('cgpi', '4', '2')->unsigned();
            $table->string('supplementaries', '200')->nullable();
            $table->timestamps();

            // Key constraints
            $table->primary(['rollNo', 'semNo']);
            $table->foreign('rollNo')
                ->references('rollNo')
                ->on('students')
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
        Schema::drop('grades');
    }
}
