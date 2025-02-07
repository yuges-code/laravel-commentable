<?php

use Yuges\Commentable\Models\Comment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct(
        protected string $table = 'comments'
    ) {
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->nullableMorphs('commentator');
            $table->morphs('commentable');

            $table
                ->foreignIdFor(Comment::class, 'parent_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->longText('original');
            $table->longText('text');
            $table->json('extra')->nullable();
            $table->unsignedBigInteger('order')->index();

            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
