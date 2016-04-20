<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLibraryStaffRequestsTable, this class
 * creates the libraryStaffRequests database table
 */
class CreateLibraryStaffRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libraryStaffRequests', function (Blueprint $table)
        {
            $table->string('rollNo', '20');
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
        Schema::drop('libraryStaffRequests');
    }
}
