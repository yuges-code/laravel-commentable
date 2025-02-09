<?php

namespace Yuges\Commentable\Traits;

use Yuges\Commentable\Config\Config;
use Yuges\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Yuges\Commentable\Interfaces\Commentator;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property Collection<int, Comment> $comments
 */
trait HasComments
{
    public function comments(): MorphMany
    {
        return $this->morphMany(Config::getCommentClass(), 'commentable');
    }

    public function comment(string $text, Commentator $commentator = null): Comment
    {
        /** @var Model */
        $commentator ??= new(Config::getCommentatorDefaultClass());

        $attributes = [
            'original' => $text,
            'commentator_id' => $commentator?->getKey() ?? null,
            'commentator_type' => $commentator?->getMorphClass() ?? null,
        ];

        if ($this instanceof Comment && $this::class === Config::getCommentClass()) {
            $attributes['commentable_id'] = $this->commentable_id;
            $attributes['commentable_type'] = $this->commentable_type;
        }

        return $this->comments()->create($attributes);
    }
}
