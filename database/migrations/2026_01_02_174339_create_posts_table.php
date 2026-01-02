<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            
            $table->id();
            // Relations
            $table->foreignId('admin_id')->constrained('admins')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();

            // Core fields
            $table->string('title');
            $table->string('slug')->unique();
            $table->json('content');
            $table->string('main_image')->nullable();
            // Status management
            $table->enum('status', ['draft', 'scheduled', 'published'])->default('draft');
            $table->timestamp('publish_at')->nullable();

            $table->timestamps();

            // Indexes for filtering and scheduler performance
            $table->index('category_id');
            $table->index('status');
            $table->index(['status', 'publish_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
