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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('type', 30)->index()
                ->comment('deposit, campaign_spend, publisher_earning, withdrawal');
            $table->decimal('amount', 10, 2);
            $table->decimal('balance_after', 10, 2);
            $table->uuid('cause_id')->nullable();
            $table->string('cause_type', 50)->nullable();
            $table->datetimes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
