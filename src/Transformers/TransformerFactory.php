<?php

namespace Yuges\Commentable\Transformers;

use Illuminate\Support\Collection;
use Yuges\Commentable\Config\Config;
use Yuges\Commentable\Models\Comment;
use Yuges\Commentable\Exceptions\InvalidTransformer;

class TransformerFactory
{
    /**
     * @param class-string $class
     * @param Comment $comment
     * 
     * @return Transformer
     */
    public static function create(string $class, Comment $comment): Transformer
    {
        static::validateTransformer($class);

        return new $class($comment);
    }

    /**
     * @param Comment $comment
     * 
     * @return Collection<int, Transformer>
     */
    public static function createAll(Comment $comment): Collection
    {
        return Config::getTransformerClasses()->map(fn (string $class) => self::create($class, $comment));
    }

    protected static function validateTransformer(string $class): void
    {
        if (! class_exists($class)) {
            throw InvalidTransformer::doesntExist($class);
        }

        if (! Config::getTransformerClasses()->contains($class)) {
            throw InvalidTransformer::doesNotContainInConfig($class);
        }

        if (! is_subclass_of($class, Transformer::class)) {
            throw InvalidTransformer::doesNotImplementTransformer($class);
        }
    }
}
