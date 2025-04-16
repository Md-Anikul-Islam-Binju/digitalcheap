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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('name');
            $table->string('package_type');
            $table->string('image')->nullable();

            $table->string('month_package_amount');
            $table->string('month_package_discount_amount')->nullable();

            $table->string('half_year_package_amount');
            $table->string('half_year_package_discount_amount')->nullable();

            $table->string('yearly_package_amount');
            $table->string('yearly_package_discount_amount')->nullable();

            $table->text('details')->nullable();

            $table->string('product_id')->nullable();

            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
