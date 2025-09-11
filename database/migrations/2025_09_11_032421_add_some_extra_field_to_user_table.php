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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['super_admin', 'admin', 'manager', 'editor', 'user'])
                ->default('user')
                ->after('id');

            // Profile-related
            $table->string('phone')->nullable()->unique()->after('email');
            $table->string('address')->nullable()->after('phone');
            $table->string('avatar')->nullable()->after('address');
            $table->date('date_of_birth')->nullable()->after('avatar');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('date_of_birth');
            $table->text('bio')->nullable()->after('gender');

            // Social links
            $table->string('facebook_url')->nullable()->after('bio');
            $table->string('twitter_url')->nullable()->after('facebook_url');
            $table->string('linkedin_url')->nullable()->after('twitter_url');
            $table->string('instagram_url')->nullable()->after('linkedin_url');
            $table->string('website')->nullable()->after('instagram_url');

            // Account state
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active')->after('role');
            $table->timestamp('last_login_at')->nullable()->after('status');
            $table->string('last_login_ip')->nullable()->after('last_login_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
