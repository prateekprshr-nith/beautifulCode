<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHostelStaffsTable, this migration
 * creates the 'hostelStaffs' table in database
 */
class CreateHostelStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostelStaffs', function (Blueprint $table)
        {
            $table->string('id', '20');
            $table->string('name', '100');
            $table->string('hostelId', '10');
            $table->string('email', '50');
            $table->string('password', '100');
            $table->boolean('firstLogin');
            $table->rememberToken();
            $table->timestamps();

            // Key constraints
            $table->primary('id');
            $table->unique('email');
            $table->foreign('hostelId')
                ->references('hostelId')
                ->on('hostels')
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
        Schema::drop('hostelStaffs');
    }
}
