<?php

use Yuges\Package\Enums\KeyType;
use Yuges\Package\Database\Schema\Schema;
use Yuges\Package\Database\Schema\Blueprint;
use Yuges\Package\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct(
        protected ?string $table = 'channels'
    ) {
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->key(KeyType::Ulid);

            $table->string('name');

            $table->timestamps();
            $table->softDeletes();
        });
    }
};
