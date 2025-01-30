<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalLineFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_line_family', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('professional_id')
            ->constrained('professionals')
            ->onDelete('cascade');
            
            $table->foreignId('line_family_id')
            ->constrained('lines_families')
            ->onDelete('restrict');
            
            $table->integer('expertise_level')->nullable(); // Nivel de experiencia en la línea/familia
            $table->timestamps();
            $table->softDeletes(); // Agrega el campo deleted_at
        });

        Schema::table('professional_line_family', function (Blueprint $table) {
            $table->unique(['professional_id', 'line_family_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professional_line_family');
    }
}
