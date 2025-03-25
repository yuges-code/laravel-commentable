<?php

namespace Yuges\Commentable\Interfaces;

use Yuges\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Commentable
{
    public function comments(): MorphMany|HasMany;

    public function comment(string $text, ?Commentator $commentator = null): Comment;

    public function defaultComentator(): ?Commentator;
}
