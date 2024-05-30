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
        Schema::table('affiliate_requests', function (Blueprint $table) {
            $table->string('payment_method')->nullable();
            $table->string('account_number')->nullable();
            $table->string('transaction_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affiliate_requests', function (Blueprint $table) {
            //
        });
    }
};
