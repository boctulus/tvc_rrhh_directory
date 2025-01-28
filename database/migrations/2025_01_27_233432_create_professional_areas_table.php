<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_areas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('professional_id');
            $table->unsignedBigInteger('area_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('professional_id')
                  ->references('id')
                  ->on('professionals')
                  ->onDelete('cascade');

            $table->foreign('area_id')
                  ->references('id')
                  ->on('areas')
                  ->onDelete('cascade');

            // Unique constraint to prevent duplicate entries
            $table->unique(['professional_id', 'area_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professional_areas');
    }
}