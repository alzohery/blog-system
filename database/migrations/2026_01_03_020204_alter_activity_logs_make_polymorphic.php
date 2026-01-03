<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            // 1. إضافة أعمدة polymorphic
            $table->unsignedBigInteger('loggable_id')->nullable()->after('admin_id');
            $table->string('loggable_type')->nullable()->after('loggable_id');
        });

        // 2. نقل الداتا القديمة (post_id -> loggable)
        DB::table('activity_logs')->update([
            'loggable_id'   => DB::raw('post_id'),
            'loggable_type' => 'App\\Models\\Post',
        ]);

        Schema::table('activity_logs', function (Blueprint $table) {
            // 3. حذف الـ FK القديم
            $table->dropForeign(['post_id']);
            $table->dropColumn('post_id');

            // 4. إضافة index للـ polymorphic
            $table->index(['loggable_id', 'loggable_type']);
        });
    }

    public function down(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            // رجوع post_id
            $table->foreignId('post_id')->nullable()->constrained('posts')->cascadeOnDelete();
        });

        DB::table('activity_logs')
            ->where('loggable_type', 'App\\Models\\Post')
            ->update([
                'post_id' => DB::raw('loggable_id'),
            ]);

        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropIndex(['loggable_id', 'loggable_type']);
            $table->dropColumn(['loggable_id', 'loggable_type']);
        });
    }
};
