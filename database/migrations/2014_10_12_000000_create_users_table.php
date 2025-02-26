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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('profile')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('is_registration_by')->nullable();
            $table->integer('verification_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('device_ip')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('google_id')->nullable()->unique();
            $table->string('avatar')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('referral_code')->nullable();
            $table->integer('referral_code_status')->default(0);
            $table->integer('referral_join_code')->nullable();

            //update
            $table->integer('join_category_id')->nullable();
            $table->integer('country_id')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
