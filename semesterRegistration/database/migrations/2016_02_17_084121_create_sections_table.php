<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSectionsTable, this migration
 * creates the 'sections' table in database
 */
class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table)
        {
            $table->string('sectionId', '10');
            $table->string('dCode', '10');
            $table->timestamps();

            // Key constraints
            $table->primary('sectionId');
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
        Schema::drop('sections');
    }
}
