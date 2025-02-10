<?php

namespace Yuges\Commentable\Transformers;

use Yuges\Commentable\Models\Comment;

abstract class AbstractTransformer implements Transformer
{
    public function __construct(
        public Comment $comment
    ) {
    }

    public static function create(Comment $comment): self
    {
        return new static($comment);
    }

    public function transform(): string
    {
        return $this->comment->text;
    }
}
