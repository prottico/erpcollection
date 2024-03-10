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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->date('credit_start_date')->nullable();
            $table->date('credit_due_date')->nullable();
            $table->string('debt_capital')->nullable();
            $table->string('term')->nullable();
            $table->string('current_interest_rate')->nullable();
            $table->string('default_interest_rate')->nullable();
            $table->string('interest_owed')->nullable();
            $table->date('last_payment_day')->nullable();
            $table->string('base_execution_document')->nullable();
            $table->string('path_base_execution_document')->nullable();
            $table->string('description')->nullable();
            $table->string('comments')->nullable();
            // $table->string('cost')->nullable();
            $table->string('code')->nullable();
            // $table->string('lawyer_commet')->nullable();
            $table->string('amount_last_payment')->nullable();
            $table->string('no_apply_last_payment_day')->nullable();
            $table->string('token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
