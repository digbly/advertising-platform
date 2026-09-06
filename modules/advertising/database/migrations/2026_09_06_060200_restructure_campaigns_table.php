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
        Schema::table('campaigns', function (Blueprint $table) {
            $table->decimal('rate', 10, 4)->after('code');
            $table->decimal('budget_total', 10, 2)->nullable();
            $table->decimal('budget_daily', 10, 2)->nullable();
            $table->json('geo_countries')->nullable();
            $table->json('device_types')->nullable();
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->string('status', 20)->default('draft')
                ->comment('draft, pending, active, paused, ended')->change();
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['views', 'amount_per_click', 'target_url']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->unsignedBigInteger('views')->default(0);
            $table->decimal('amount_per_click', 10, 4);
            $table->string('target_url', 500);
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->string('status', 20)->default('draft')
                ->comment('draft, publish')->change();
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['rate', 'budget_total', 'budget_daily', 'geo_countries', 'device_types']);
        });
    }
};
