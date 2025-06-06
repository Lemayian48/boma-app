<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('ads', function (Blueprint $table) {
            $table->json('description_tiptap')->nullable()->after('description');
        });
    }

    public function down(): void {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('description_tiptap');
        });
    }
};
