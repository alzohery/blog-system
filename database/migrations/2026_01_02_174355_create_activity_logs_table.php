<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // Actor and target
            $table->foreignId('admin_id')->constrained('admins')->cascadeOnDelete();
            $table->foreignId('post_id')->constrained('posts')->cascadeOnDelete();

            // Action descriptor
            $table->string('action', 100);

            // Timestamp
            $table->timestamp('created_at')->useCurrent();

            // Indexes for filtering
            $table->index(['admin_id', 'created_at']); // compound index for admin + time period
            $table->index('action'); // filter by action type
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
