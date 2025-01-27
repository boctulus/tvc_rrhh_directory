<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalBrandsTable extends Migration
{
    public function up()
    {
        Schema::create('professional_brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('professional_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Índice único compuesto para name y professional_id
            $table->unique(['name', 'professional_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('professional_brands');
    }
} 