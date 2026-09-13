<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        DB::table('groups')
            ->orderBy('id')
            ->get(['id', 'title'])
            ->each(function (object $group): void {
                $baseSlug = Str::slug((string) $group->title) ?: "group-{$group->id}";
                $slug = $baseSlug;
                $suffix = 2;

                while (DB::table('groups')->where('slug', $slug)->exists()) {
                    $slug = "{$baseSlug}-{$suffix}";
                    $suffix++;
                }

                DB::table('groups')->where('id', $group->id)->update(['slug' => $slug]);
            });

        Schema::table('groups', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
