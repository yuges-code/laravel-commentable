<?php

use Yuges\Commentable\Config\Config;
use Yuges\Commentable\Models\Comment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct(protected string $table = 'comments')
    {
        Config::getCommentClass(Comment::class)::getTableName();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->ulid('id')->primary();

            Config::getPermissionsAnonymous(false)
                ? $table->nullableMorphs('commentator')
                : $table->morphs('commentator');

            $table->morphs('commentable');
        });

        Schema::table($this->table, function (Blueprint $table) {
            $table
                ->foreignIdFor(Config::getCommentClass(Comment::class), 'parent_id')
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
