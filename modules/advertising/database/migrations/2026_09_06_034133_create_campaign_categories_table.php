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
        Schema::create('campaign_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('active')->index()->default(true);
            $table->uuid('parent_id')->nullable();
            $table->datetimes();
        });

        Schema::create('campaign_category_translations', function (Blueprint $table) {
            $table->id();
            $table->uuid('campaign_category_id');
            $table->string('locale', 10);
            $table->string('name', 100);
            $table->string('slug', 190)->unique();
            $table->string('description', 255)->nullable();

            $table->foreign('campaign_category_id')
                ->references('id')
                ->on('campaign_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_category_translations');
        Schema::dropIfExists('campaign_categories');
    }
};
