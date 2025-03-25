<?php

namespace Yuges\Commentable\Providers;

use Yuges\Package\Data\Package;
use Yuges\Commentable\Config\Config;
use Yuges\Commentable\Models\Comment;
use Yuges\Commentable\Observers\CommentObserver;
use Yuges\Commentable\Exceptions\InvalidComment;
use Yuges\Package\Providers\PackageServiceProvider;

class CommentableServiceProvider extends PackageServiceProvider
{
    protected string $name = 'laravel-commentable';

    public function configure(Package $package): void
    {
        $comment = Config::getCommentClass(Comment::class);

        if (! is_a($comment, Comment::class, true)) {
            throw InvalidComment::doesNotImplementComment($comment);
        }

        $package
            ->hasName($this->name)
            ->hasConfig('commentable')
            ->hasMigrations([
                'create_comments_table',
            ])
            ->hasObserver($comment, CommentObserver::class);
    }
}
