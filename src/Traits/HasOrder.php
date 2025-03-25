<?php

namespace Yuges\Commentable\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $order
 */
trait HasOrder
{
    public function setHighestOrderNumber(): void
    {
        $column = $this->determineOrderColumnName();

        $this->$column = $this->getHighestOrderNumber() + 1;
    }

    public function getHighestOrderNumber(): int
    {
        return (int) static::where('commentable_type', $this->commentable_type)
            ->where('commentable_id', $this->commentable_id)
            ->where('parent_id', $this->parent_id)
            ->max($this->determineOrderColumnName());
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy($this->determineOrderColumnName());
    }

    protected function determineOrderColumnName(): string
    {
        return 'order';
    }

    public function shouldSortWhenCreating(): bool
    {
        return true;
    }
}
