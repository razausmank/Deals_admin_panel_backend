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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->bigInteger('views')->default(0);
            $table->string('image')->nullable();
            $table->string('pdf')->nullable();
            $table->boolean('is_published')->default(false);
            $table->bigInteger('store_id');
            $table->string('resource_link')->nullable();
            $table->date('promotion_start_date')->nullable();
            $table->date('promotion_end_date')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
