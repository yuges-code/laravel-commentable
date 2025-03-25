<?php

namespace Yuges\Commentable\Traits;

use Illuminate\Support\Facades\Auth;
use Yuges\Commentable\Config\Config;
use Yuges\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Yuges\Commentable\Interfaces\Commentator;
use Yuges\Commentable\Actions\CreateCommentAction;
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
        return CreateCommentAction::create($this)->execute($text, $commentator);
    }

    public function defaultComentator(): ?Commentator
    {
        /** @var ?Commentator */
        $commentator = Auth::user();

        return $commentator;
    }
}
