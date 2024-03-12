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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('identity_type_id')->nullable();
            $table->foreign('identity_type_id')->references('id')->on('identity_types')->after('name')->onDelete('cascade');
            $table->string('identification');
            $table->string('name');
            $table->string('phone');
            $table->string('token');
            $table->string('comercial_name');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
