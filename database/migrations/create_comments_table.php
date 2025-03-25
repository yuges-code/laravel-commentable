<?php

use Yuges\Package\Enums\KeyType;
use Yuges\Commentable\Config\Config;
use Yuges\Commentable\Models\Comment;
use Yuges\Package\Database\Schema\Schema;
use Yuges\Package\Database\Schema\Blueprint;
use Yuges\Package\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct()
    {
        $this->table = Config::getCommentClass(Comment::class)::getTableName();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->key(Config::getCommentKeyType(KeyType::BigInteger));

            Config::getPermissionsAnonymous(false)
                ? $table->nullableKeyMorphs(Config::getCommentatorKeyType(KeyType::BigInteger), 'commentator')
                : $table->keyMorphs(Config::getCommentatorKeyType(KeyType::BigInteger), 'commentator');

            $table->keyMorphs(Config::getCommentableKeyType(KeyType::BigInteger), 'commentable');
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
            $table->order();

            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
