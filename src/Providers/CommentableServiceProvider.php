<?php

namespace Yuges\Commentable\Providers;

use Exception;
use Yuges\Commentable\Config\Config;
use Yuges\Commentable\Models\Comment;
use Illuminate\Support\ServiceProvider;
use Yuges\Commentable\Observers\CommentObserver;

class CommentableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /** @var Comment */
        $class = Config::getCommentClass(Comment::class);

        if (! is_a(new $class, Comment::class)) {
            throw new Exception('Invalid comment model');
        }

        $class::observe(new CommentObserver);

        $this->publishes([
            __DIR__.'/../../config/commentable.php' => config_path('commentable.php')
        ], 'commentable-config');

        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations')
        ], 'commentable-migrations');
    }
}
