<?php

namespace Yuges\Commentable\Exceptions;

use Exception;
use Yuges\Commentable\Sanitizers\Sanitizer;

class InvalidSanitizer extends Exception
{
    public static function doesNotContainInConfig(string $class): self
    {
        return new static("Sanitizer class `{$class}` doesn't contain in sanitizers config");
    }

    public static function doesntExist(string $class): self
    {
        return new static("Sanitizer class `{$class}` doesn't exist");
    }

    public static function doesNotImplementSanitizer(string $class): self
    {
        $sanitizer = Sanitizer::class;

        return new static("Sanitizer class `{$class}` must implement `$sanitizer}`");
    }
}
