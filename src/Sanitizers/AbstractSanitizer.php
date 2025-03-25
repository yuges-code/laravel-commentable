<?php

namespace Yuges\Commentable\Sanitizers;

use Yuges\Commentable\Models\Comment;

abstract class AbstractSanitizer implements Sanitizer
{
    public function __construct(
        public Comment $comment
    ) {
    }

    public static function create(Comment $comment): self
    {
        return new static($comment);
    }

    public function sanitize(): string
    {
        return $this->comment->text;
    }
}
