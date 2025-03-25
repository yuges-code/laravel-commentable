<?php

namespace Yuges\Commentable\Actions;

use Exception;
use Yuges\Commentable\Config\Config;
use Yuges\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Yuges\Commentable\Interfaces\Commentable;
use Yuges\Commentable\Interfaces\Commentator;
use Yuges\Commentable\Exceptions\InvalidCommentator;

class CreateCommentAction
{
    public function __construct(
        protected Commentable $commentable
    ) {
    }

    public static function create(Commentable $commentable): self
    {
        return new static($commentable);
    }

    public function execute(string $text, ?Commentator $commentator = null): Comment
    {
        $commentator ??= $this->getDefaultComentator();

        $this->validateCommentator($commentator);

        if (! $commentator instanceof Model) {
            throw new Exception('Commentator is not eloquent model');
        }

        $attributes = [
            'original' => $text,
            'commentator_id' => $commentator?->getKey() ?? null,
            'commentator_type' => $commentator?->getMorphClass() ?? null,
        ];

        if (
            $this->commentable instanceof Comment &&
            get_class($this->commentable) === Config::getCommentClass()
        ) {
            $attributes['commentable_id'] = $this->commentable->commentable_id;
            $attributes['commentable_type'] = $this->commentable->commentable_type;
        }

        return $this->commentable->comments()->create($attributes);
    }

    public function validateCommentator(?Commentator $commentator = null): void
    {
        if (! $commentator) {
            return;
        }

        $class = get_class($commentator);
        $allowed = Config::getCommentatorAllowedClasses()->push(Config::getCommentatorDefaultClass());

        if (! $allowed->contains($class)) {
            throw InvalidCommentator::doesNotContainInAllowedConfig($class);
        }
    }

    public function getDefaultComentator(): ?Commentator
    {
        $commentator = $this->commentable->defaultComentator();

        if (! $commentator) {
            return null;
        }

        $class = get_class($commentator);

        if (Config::getCommentatorDefaultClass() !== $class) {
            throw InvalidCommentator::doesNotContainInDefaultConfig($class);
        }

        return $commentator;
    }
}
