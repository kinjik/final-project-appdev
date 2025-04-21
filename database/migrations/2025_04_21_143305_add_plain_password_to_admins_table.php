<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('plain_password')->nullable()->after('password'); // or after username, depending on your schema
        });
    }

    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('plain_password');
        });
    }
};
