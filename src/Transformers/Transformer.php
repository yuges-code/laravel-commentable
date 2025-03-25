<?php

namespace Yuges\Commentable\Transformers;

use Yuges\Commentable\Models\Comment;

interface Transformer
{
    public function __construct(Comment $comment);

    public static function create(Comment $comment): self;

    public function transform(): string;
}
