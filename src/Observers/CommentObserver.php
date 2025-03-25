<?php

namespace Yuges\Commentable\Observers;

use Carbon\Carbon;
use Yuges\Commentable\Models\Comment;
use Yuges\Commentable\Actions\ProcessCommentAction;

class CommentObserver
{
    public function creating(Comment $comment): void
    {
        if ($comment->shouldSortWhenCreating()) {
            if (is_null($comment->order)) {
                $comment->setHighestOrderNumber();
            }
        }

        $comment->approved_at = Carbon::now();
    }

    public function updating(Comment $comment): void
    {

    }

    public function saving(Comment $comment): void
    {
        ProcessCommentAction::create($comment)->execute();
    }

    public function deleted(Comment $comment): void
    {

    }
}
