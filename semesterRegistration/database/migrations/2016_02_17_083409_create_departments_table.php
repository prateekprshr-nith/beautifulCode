<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDepartmentsTable, this migration
 * creates the 'departments' table in database
 */
class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table)
        {
            $table->string('dCode', '10')->unique();
            $table->string('dName', '100');
            $table->timestamps();

            // Keys
            $table->primary('dCode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('departments');
    }
}
