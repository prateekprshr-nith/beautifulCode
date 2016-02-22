<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAdminStaffsTable, this migration
 * creates the 'adminStaffs' table in database
 */
class CreateAdminStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminStaffs', function (Blueprint $table)
        {
            $table->string('id', '20');
            $table->string('name', '100');
            $table->string('email', '50');
            $table->string('password', '50');
            $table->rememberToken();
            $table->timestamps();

            // Key constraints
            $table->primary('id');
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('adminStaffs');
    }
}
