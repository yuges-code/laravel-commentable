<?php

namespace Yuges\Commentable\Traits;

use Yuges\Commentable\Interfaces\Commentable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $commentable_type
 * @property int|string $commentable_id
 * 
 * @property Commentable $commentable
 */
trait HasCommentable
{
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
