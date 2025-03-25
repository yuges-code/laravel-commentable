<?php

namespace Yuges\Commentable\Config;

use Yuges\Package\Enums\KeyType;
use Illuminate\Support\Collection;
use Yuges\Commentable\Models\Comment;
use Yuges\Commentable\Sanitizers\Sanitizer;
use Yuges\Commentable\Interfaces\Commentator;
use Yuges\Commentable\Interfaces\Commentable;
use Yuges\Commentable\Transformers\Transformer;

class Config extends \Yuges\Package\Config\Config
{
    const string NAME = 'commentable';

    /** @return class-string<Comment> */
    public static function getCommentClass(mixed $default = null): string
    {
        return self::get('models.comment.class', $default);
    }

    public static function getCommentKeyType(mixed $default = null): KeyType
    {
        return self::get('models.comment.key', $default);
    }

    /** @return class-string<Commentator> */
    public static function getCommentatorDefaultClass(mixed $default = null): string
    {
        return self::get('models.commentator.default.class', $default);
    }

    /** @return Collection<array-key, class-string<Commentator>> */
    public static function getCommentatorAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.commentator.allowed.classes', $default)
        );
    }

    public static function getCommentatorKeyType(mixed $default = null): KeyType
    {
        return self::get('models.commentator.key', $default);
    }

    /** @return class-string<Commentable> */
    public static function getCommentableDefaultClass(mixed $default = null): string
    {
        return self::get('models.commentable.default.class', $default);
    }

    /** @return Collection<array-key, class-string<Commentable>> */
    public static function getCommentableAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.commentable.allowed.classes', $default)
        );
    }

    public static function getCommentableKeyType(mixed $default = null): KeyType
    {
        return self::get('models.commentable.key', $default);
    }

    /** @return Collection<array-key, class-string<Sanitizer>> */
    public static function getSanitizerClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('sanitizers', $default)
        );
    }

    /** @return Collection<array-key, class-string<Transformer>> */
    public static function getTransformerClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('transformers', $default)
        );
    }

    public static function getPermissionsAnonymous(mixed $default = false): bool
    {
        return self::get('permissions.anonymous', $default);
    }
}
