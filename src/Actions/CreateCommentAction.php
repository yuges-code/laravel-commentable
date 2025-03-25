<?php

namespace Yuges\Commentable\Actions;

use Exception;
use Yuges\Subscribable\Config\Config;
use Illuminate\Database\Eloquent\Model;
use Yuges\Commentable\Interfaces\Commentable;
use Yuges\Commentable\Interfaces\Commentator;
use Yuges\Commentable\Models\Comment;
use Yuges\Subscribable\Interfaces\Subscriber;
use Yuges\Subscribable\Exceptions\InvalidSubscriber;

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
        $subscriber ??= $this->getDefaultSubscriber();

        $this->validateSubscriber($subscriber);

        if (! $subscriber instanceof Model) {
            throw new Exception('Subscriber is not eloquent model');
        }

        $attributes = [
            'plan_id' => $plan?->getKey() ?? null,
            'subscriber_id' => $subscriber?->getKey() ?? null,
            'subscriber_type' => $subscriber?->getMorphClass() ?? null,
        ];

        $subscription = $this->subscribable
            ->subscribableSubscriptions()
            ->getQuery()
            ->whereMorphedTo('subscriber', $subscriber)
            ->first();

        return $subscription ?? $this->subscribable->subscribableSubscriptions()->create($attributes);
    }

    public function validateSubscriber(?Subscriber $subscriber = null): void
    {
        if (! $subscriber) {
            return;
        }

        $class = get_class($subscriber);
        $allowed = Config::getSubscriberAllowedClasses()->push(Config::getSubscriberDefaultClass());

        if (! $allowed->contains($class)) {
            throw InvalidSubscriber::doesNotContainInAllowedConfig($class);
        }
    }

    public function getDefaultSubscriber(): ?Subscriber
    {
        $subscriber = $this->subscribable->defaultSubscriber();

        if (! $subscriber) {
            return null;
        }

        $class = get_class($subscriber);

        if (Config::getSubscriberDefaultClass() !== $class) {
            throw InvalidSubscriber::doesNotContainInDefaultConfig($class);
        }

        return $subscriber;
    }
}
