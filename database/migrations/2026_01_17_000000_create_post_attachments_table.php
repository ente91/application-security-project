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
        Schema::create('post_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')
                ->constrained('posts')
                ->onDelete('cascade');

            // Original filename as uploaded by the user
            $table->string('original_name');

            // Relative path on the storage disk (public)
            $table->string('path');

            // MIME type reported by PHP/Laravel
            $table->string('mime')->nullable();

            // Size in bytes
            $table->unsignedBigInteger('size')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_attachments');
    }
};
