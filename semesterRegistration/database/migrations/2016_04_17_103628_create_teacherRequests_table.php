<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTeacherRequestsTable, this class
 * creates the teacherRequests database table
 */
class CreateTeacherRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacherRequests', function (Blueprint $table)
        {
            $table->string('rollNo', '20');
            $table->string('status', '20');
            $table->string('imagePath', '200');
            $table->string('remarks', '200') ->nullable();
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
        Schema::drop('teacherRequests');
    }
}
