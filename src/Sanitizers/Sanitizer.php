<?php

namespace Yuges\Commentable\Sanitizers;

use Yuges\Commentable\Models\Comment;

interface Sanitizer
{
    public function __construct(Comment $comment);

    public static function create(Comment $comment): self;

    public function sanitize(): string;
}
