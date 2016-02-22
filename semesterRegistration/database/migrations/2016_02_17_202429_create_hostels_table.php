<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHostelsTable, this migration
 * creates the 'hostels' table in databse
 */
class CreateHostelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostels', function (Blueprint $table)
        {
            $table->string('hostelId', '10');
            $table->string('name', '100');
            $table->timestamps();

            // Key constraints
            $table->primary('hostelId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hostels');
    }
}
