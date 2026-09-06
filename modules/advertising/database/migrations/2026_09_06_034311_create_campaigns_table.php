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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->uuid('category_id')->nullable();
            $table->string('code', 16)->unique();
            $table->string('status', 20)->index()->default('draft')
                ->comment('draft, publish');
            $table->unsignedBigInteger('views')->default(0);
            $table->decimal('amount_per_click', 10, 4);
            $table->uuid('user_id');
            $table->string('target_url', 500);
            $table->datetimes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('campaign_categories')
                ->onDelete('set null');
        });

        Schema::create('campaign_translations', function (Blueprint $table) {
            $table->id();
            $table->uuid('campaign_id');
            $table->string('locale', 10)->index();
            $table->string('title', 200)->nullable();
            $table->string('description', 250)->nullable();
            $table->string('slug', 190)->unique();
            $table->datetimes();

            $table->unique(['campaign_id', 'locale']);
            $table->foreign('campaign_id')
                ->references('id')
                ->on('campaigns')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_translations');
        Schema::dropIfExists('campaigns');
    }
};
