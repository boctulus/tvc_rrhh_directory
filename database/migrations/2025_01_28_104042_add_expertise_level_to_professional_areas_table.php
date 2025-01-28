<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpertiseLevelToProfessionalAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professional_areas', function (Blueprint $table) {
            $table->integer('expertise_level')
                  ->nullable()
                  ->default(3)
                  ->comment('Expertise level for the area (1-5)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professional_areas', function (Blueprint $table) {
            $table->dropColumn('expertise_level');
        });
    }
}