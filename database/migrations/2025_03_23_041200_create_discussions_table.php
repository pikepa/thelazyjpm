<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("discussions", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("user_id")
                ->nullable()
                ->constrained()
                ->onDelete("set null");
            $table->foreignId("topic_id")->constrained();
            $table
                ->foreignId("solution_post_id")
                ->nullable()
                ->constrained("posts")
                ->onDelete("set null");
            $table->string("title");
            $table->string("slug")->unique()->nullable();
            $table->timestamp("pinned_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("discussions");
    }
};
