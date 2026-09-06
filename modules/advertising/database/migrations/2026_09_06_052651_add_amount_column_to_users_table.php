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
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('company_name', 150)->nullable();
            $table->string('payout_method', 50)->nullable();
            $table->string('payout_account', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['amount', 'company_name', 'payout_method', 'payout_account']);
        });
    }
};
