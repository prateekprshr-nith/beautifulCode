<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiefWardenStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chiefWardenStaffs', function (Blueprint $table) {
            $table->string('id', '20');
            $table->string('name', '100');
            $table->string('email', '50');
            $table->string('password', '100');
            $table->boolean('firstLogin');
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
        Schema::drop('chiefWardenStaffs');
    }
}
