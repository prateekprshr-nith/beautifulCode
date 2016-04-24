<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHostelStaffRequestsTable, this class
 * creates the hostelStaffRequests database table
 */
class CreateHostelStaffRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostelStaffRequests', function (Blueprint $table)
        {
            $table->string('rollNo', '20');
            $table->string('hostelId', '10');
            $table->string('status', '20');
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
        Schema::drop('hostelStaffRequests');
    }
}
