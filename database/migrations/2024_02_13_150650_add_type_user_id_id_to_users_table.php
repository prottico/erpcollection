<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::table('users', function (Blueprint $table) {
        //     $table->unsignedBigInteger('type_user_id')->nullable();
        //     $table->foreign('type_user_id')->references('id')->on('user_types')->after('name');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('users', function (Blueprint $table) {
        //     $table->dropForeign(['type_user_id']);
        //     $table->dropColumn('type_user_id');
        // });
    }
};
