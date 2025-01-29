<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalCertificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_certification', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('professional_id')
            ->constrained('professionals')
            ->onDelete('cascade');
            
            $table->foreignId('certification_id')
            ->constrained('certifications')
            ->onDelete('restrict');
            
            $table->timestamps();
            $table->softDeletes(); // Agrega el campo deleted_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professional_certification');
    }
}
