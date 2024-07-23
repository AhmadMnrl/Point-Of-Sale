<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    public function up(): void
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id(); // Default ID column
            $table->string('request_id')->unique(); // Add request_id column with unique constraint
            $table->string('request_type');
            $table->string('item_name')->nullable();
            $table->foreignId('item_id')->nullable()->constrained('barangs')->onDelete('set null');
            $table->integer('price')->nullable(); // Adjusted to nullable for flexibility
            $table->text('description')->nullable();
            $table->string('status')->default('submitted');
            $table->unsignedBigInteger('user_id'); // Ensure this exists
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
}
