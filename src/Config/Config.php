<?php

namespace Yuges\Commentable\Config;

use Illuminate\Support\Collection;
use Yuges\Commentable\Models\Comment;
use Yuges\Commentable\Sanitizers\Sanitizer;
use Yuges\Commentable\Interfaces\Commentator;
use Yuges\Commentable\Transformers\Transformer;
use Illuminate\Support\Facades\Config as ConfigFacade;

class Config
{
    const string NAME = 'commentable';

    /** @return class-string<Comment> */
    public static function getCommentClass(mixed $default = null): string
    {
        return self::get('models.comment', $default);
    }

    /** @return Collection<array-key, class-string<Commentator>> */
    public static function getCommentatorAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.commentator.allowed', $default)
        );
    }

    /** @return class-string<Commentator> */
    public static function getCommentatorDefaultClass(mixed $default = null): string
    {
        return self::get('models.commentator.default', $default);
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

    public static function get(string $key, mixed $default = null): mixed
    {
        return ConfigFacade::get(self::NAME . '.' . $key, $default);
    }
}
