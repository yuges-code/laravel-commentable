<?php

namespace Yuges\Commentable\Transformers;

class CommentTransformer extends AbstractTransformer
{
    public function transform(): string
    {
        // code...

        return $this->comment->text = $this->comment->text;
    }
}
