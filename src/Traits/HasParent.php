<?php

namespace Yuges\Commentable\Traits;

use Yuges\Commentable\Config\Config;
use Yuges\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property ?string $parent_id
 * 
 * @property Collection<array-key, Comment> $nested
 * @property Collection<array-key, Comment> $comments
 * @property Collection<array-key, Comment> $children
 */
trait HasParent
{
    public function nested(): HasMany
    {
        return $this->children();
    }

    public function comments(): HasMany
    {
        return $this->children();
    }

    public function children(): HasMany
    {
        return $this->hasMany(Config::getCommentClass(Comment::class), 'parent_id');
    }

    public function isParentless(): bool
    {
        return ! $this->parent_id;
    }
}
