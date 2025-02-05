<?php

namespace Yuges\Commentable\Observers;

use Yuges\Commentable\Models\Comment;

class CommentObserver
{
    public function creating(Comment $comment): void
    {
        if ($comment->shouldSortWhenCreating()) {
            if (is_null($comment->order)) {
                $comment->setHighestOrderNumber();
            }
        }
    }

    public function updating(Comment $comment): void
    {

    }

    public function deleted(Comment $comment): void
    {

    }
}
