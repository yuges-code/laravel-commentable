<?php

namespace Yuges\Commentable\Traits;

use Illuminate\Support\Facades\Auth;
use Yuges\Commentable\Config\Config;
use Yuges\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Yuges\Commentable\Interfaces\Commentator;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property array $comments
 */
trait HasComments
{
    public function comments(): MorphMany
    {
        return $this->morphMany(Config::getCommentModel(), 'commentable');
    }

    public function comment(string $text, Commentator $commentator = null): Comment
    {
        /** @var Model */
        $commentator ??= Auth::user();

        $parentId = ($this::class === Config::getCommentModel())
            ? $this->getKey()
            : null;

        $comment = $this->comments()->create([
            'commentator_id' => $commentator?->getKey() ?? null,
            'commentator_type' => $commentator?->getMorphClass() ?? null,
            'original_text' => $text,
            'parent_id' => $parentId,
        ]);

        return $comment;
    }
}
