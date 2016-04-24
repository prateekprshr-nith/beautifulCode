<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDepartmentStaffsTable, this class
 * creates the departmentStaffs database table
 */
class CreateDepartmentStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departmentStaffs', function (Blueprint $table)
        {
            $table->string('id', '20');
            $table->string('name', '100');
            $table->string('email', '50');
            $table->string('dCode', '10');
            $table->string('password', '100');
            $table->boolean('firstLogin');
            $table->rememberToken();
            $table->timestamps();

            // Key constraints
            $table->primary('id');
            $table->unique('email');
            $table->foreign('dCode')
                ->references('dCode')
                ->on('departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('departmentStaffs');
    }
}
