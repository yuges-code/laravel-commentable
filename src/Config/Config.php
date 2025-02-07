<?php

namespace Yuges\Commentable\Config;

use Illuminate\Support\Collection;
use Yuges\Commentable\Models\Comment;
use Yuges\Commentable\Interfaces\Commentator;
use Illuminate\Support\Facades\Config as ConfigFacade;

class Config
{
    const string NAME = 'commentable';

    /** @return class-string<Comment> */
    public static function getCommentModel(): string
    {
        return self::get('models.comment');
    }

    /** @return Collection<class-string<Commentator>> */
    public static function getCommentatorAllowedModels(): Collection
    {
        return Collection::make(
            self::get('models.commentator.allowed')
        );
    }

    /** @return class-string<Commentator> */
    public static function getCommentatorDefaultModel(): string
    {
        return Collection::make(
            self::get('models.commentator.default')
        );
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return ConfigFacade::get(self::NAME . '.' . $key);
    }
}
