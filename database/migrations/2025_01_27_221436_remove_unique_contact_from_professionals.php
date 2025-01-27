<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUniqueContactFromProfessionals extends Migration
{
    public function up()
    {
        Schema::table('professionals', function (Blueprint $table) {
            // Drop the unique index on contact
            $table->dropUnique('professionals_contact_unique');
        });
    }

    public function down()
    {
        Schema::table('professionals', function (Blueprint $table) {
            // Restore the unique index if needed
            $table->unique('contact');
        });
    }
}