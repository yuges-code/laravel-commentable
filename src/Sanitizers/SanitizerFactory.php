<?php

namespace Yuges\Commentable\Sanitizers;

use Illuminate\Support\Collection;
use Yuges\Commentable\Config\Config;
use Yuges\Commentable\Models\Comment;
use Yuges\Commentable\Exceptions\InvalidSanitizer;

class SanitizerFactory
{
    /**
     * @param class-string $class
     * @param Comment $comment
     * 
     * @return Sanitizer
     */
    public static function create(string $class, Comment $comment): Sanitizer
    {
        static::validateSanitizer($class);

        return new $class($comment);
    }

    /**
     * @param Comment $comment
     * 
     * @return Collection<int, Sanitizer>
     */
    public static function createAll(Comment $comment): Collection
    {
        return Config::getSanitizerClasses()->map(fn (string $class) => self::create($class, $comment));
    }

    protected static function validateSanitizer(string $class): void
    {
        if (! class_exists($class)) {
            throw InvalidSanitizer::doesntExist($class);
        }

        if (! Config::getSanitizerClasses()->contains($class)) {
            throw InvalidSanitizer::doesNotContainInConfig($class);
        }

        if (! is_subclass_of($class, Sanitizer::class)) {
            throw InvalidSanitizer::doesNotImplementSanitizer($class);
        }
    }
}
