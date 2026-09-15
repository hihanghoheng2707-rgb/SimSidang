<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index('role');
        });

        Schema::table('schedules', function (Blueprint $table) {
            $table->index(['tanggal_sidang', 'jam_mulai', 'jam_selesai']);
        });

        Schema::table('submissions', function (Blueprint $table) {
            $table->index('status');
            $table->index(['schedule_id', 'status']);
        });

        Schema::table('revision_notes', function (Blueprint $table) {
            $table->index(['status_poin', 'created_at']);
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->index(['notifiable_id', 'read_at']);
        });

        Schema::table('assistant_conversations', function (Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('assessment_forms', function (Blueprint $table) {
            $table->index('tipe_penilai');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
        });

        Schema::table('schedules', function (Blueprint $table) {
            $table->dropIndex(['tanggal_sidang', 'jam_mulai', 'jam_selesai']);
        });

        Schema::table('submissions', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['schedule_id', 'status']);
        });

        Schema::table('revision_notes', function (Blueprint $table) {
            $table->dropIndex(['status_poin', 'created_at']);
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropIndex(['notifiable_id', 'read_at']);
        });

        Schema::table('assistant_conversations', function (Blueprint $table) {
            $table->dropIndex('updated_at');
        });

        Schema::table('assessment_forms', function (Blueprint $table) {
            $table->dropIndex('tipe_penilai');
        });
    }
};
