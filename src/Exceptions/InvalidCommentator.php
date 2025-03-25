<?php

namespace Yuges\Commentable\Exceptions;

use Exception;

class InvalidCommentator extends Exception
{
    public static function doesNotContainInAllowedConfig(string $class): self
    {
        return new static("Commentator class `{$class}` doesn't contain in allowed commentators config");
    }

    public static function doesNotContainInDefaultConfig(string $class): self
    {
        return new static("Commentator class `{$class}` doesn't contain in default commentator config");
    }
}
