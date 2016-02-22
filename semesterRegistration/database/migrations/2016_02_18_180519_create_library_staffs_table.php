<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLibraryStaffsTable, this migration
 * creates the 'libraryStaff' model in database
 */
class CreateLibraryStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libraryStaffs', function (Blueprint $table)
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
        Schema::drop('libraryStaffs');
    }
}
