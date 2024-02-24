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
        Schema::table('people', function (Blueprint $table) {
            $table->unsignedBigInteger('identity_type_id')->nullable();
            $table->foreign('identity_type_id')->references('id')->on('identity_types')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropForeign(['identity_type_id']);
            $table->dropColumn('identity_type_id');
        });
    }
};
