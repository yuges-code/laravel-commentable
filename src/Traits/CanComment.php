<?php

namespace Yuges\Commentable\Traits;

use Yuges\Commentable\Config\Config;
use Yuges\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property Collection<int, Comment> $comments
 */
trait CanComment
{
    public function comments(): MorphMany
    {
        return $this->morphMany(Config::getCommentClass(), 'commentator');
    }
}
