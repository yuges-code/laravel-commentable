<?php

namespace Yuges\Commentable\Exceptions;

use Exception;
use TypeError;
use Yuges\Commentable\Models\Comment;

class InvalidComment extends Exception
{
    public static function doesNotImplementComment(string $class): TypeError
    {
        $comment = Comment::class;

        return new TypeError("Comment class `{$class}` must implement `{$comment}`");
    }
}
