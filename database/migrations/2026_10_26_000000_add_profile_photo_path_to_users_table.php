<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds the column the header avatar reads from (PostgreSQL friendly).
 * Skip / delete this file if your users table already has a column for the profile picture
 * (then change "profile_photo_path" in app/Models/User.php to that column name).
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users') && ! Schema::hasColumn('users', 'profile_photo_path')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('profile_photo_path', 2048)->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'profile_photo_path')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('profile_photo_path');
            });
        }
    }
};
