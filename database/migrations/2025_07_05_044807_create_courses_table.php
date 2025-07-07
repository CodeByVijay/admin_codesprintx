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
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->nullable()->index();
            $table->string('slug')->nullable()->index();
            $table->string('icon')->nullable();
            $table->string('bg_color')->nullable();
            $table->text('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
            $table->json('skills')->nullable();
            $table->json('what_you_learn')->nullable();
            $table->json('projects')->nullable();
            $table->decimal('price_3_month', 10, 2)->nullable();
            $table->decimal('price_6_month', 10, 2)->nullable();
            $table->decimal('original_price_3_month', 10, 2)->nullable();
            $table->decimal('original_price_6_month', 10, 2)->nullable();
            $table->timestamp('offer_end_at')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
