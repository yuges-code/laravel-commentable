<?php

namespace Yuges\Commentable\Sanitizers;

class CommentSanitizer extends AbstractSanitizer
{
    public function sanitize(): string
    {
        // code...

        return $this->comment->text = $this->comment->text;
    }
}
