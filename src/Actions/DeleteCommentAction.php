<?php

namespace Yuges\Commentable\Actions;

use Exception;
use Yuges\Subscribable\Models\Plan;
use Yuges\Subscribable\Config\Config;
use Illuminate\Database\Eloquent\Model;
use Yuges\Subscribable\Interfaces\Subscriber;
use Yuges\Subscribable\Interfaces\Subscribable;
use Yuges\Subscribable\Exceptions\InvalidSubscriber;

class DeleteCommentAction
{
    public function __construct(
        protected Subscribable $subscribable
    ) {
    }

    public static function create(Subscribable $subscribable): self
    {
        return new static($subscribable);
    }

    public function execute(?Subscriber $subscriber = null, ?Plan $plan = null): mixed
    {
        $subscriber ??= $this->getDefaultSubscriber();

        $this->validateSubscriber($subscriber);

        if (! $subscriber instanceof Model) {
            throw new Exception('Subscriber is not eloquent model');
        }

        return $this->subscribable
            ->subscribableSubscriptions()
            ->getQuery()
            ->whereMorphedTo('subscriber', $subscriber)
            ->where('plan_id', '=', $plan?->getKey() ?? null)
            ->delete();
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
