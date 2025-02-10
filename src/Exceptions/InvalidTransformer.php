<?php

namespace Yuges\Commentable\Exceptions;

use Exception;
use Yuges\Commentable\Transformers\Transformer;

class InvalidTransformer extends Exception
{
    public static function doesNotContainInConfig(string $class): self
    {
        return new static("Transformer class `{$class}` doesn't contain in transformers config");
    }

    public static function doesntExist(string $class): self
    {
        return new static("Transformer class `{$class}` doesn't exist");
    }

    public static function doesNotImplementTransformer(string $class): self
    {
        $transformer = Transformer::class;

        return new static("Transformer class `{$class}` must implement `$transformer}`");
    }
}
