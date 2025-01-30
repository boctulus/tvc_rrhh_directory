<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvatarStorageToProfessionalsTable extends Migration
{
    public function up()
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->string('avatar_storage')->nullable()->after('img_url');
        });
    }

    public function down()
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->dropColumn('avatar_storage');
        });
    }
}