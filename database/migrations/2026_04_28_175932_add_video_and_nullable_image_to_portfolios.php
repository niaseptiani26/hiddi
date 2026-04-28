<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            // bikin image_path jadi nullable
            $table->string('image_path')->nullable()->change();

            // tambah video_path
            $table->string('video_path')->nullable()->after('image_path');

            // tambah type (biar tau ini foto / video)
            $table->enum('type', ['image','video'])->default('image')->after('video_path');
        });
    }

    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn('video_path');
            $table->dropColumn('type');

            $table->string('image_path')->nullable(false)->change();
        });
    }
};
