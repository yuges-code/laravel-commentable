<?php

namespace Yuges\Commentable\Traits;

use Yuges\Commentable\Interfaces\Commentator;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $commentator_type
 * @property int|string $commentator_id
 * 
 * @property Commentator $commentator
 */
trait HasCommentator
{
    public function commentator(): MorphTo
    {
        return $this->morphTo();
    }
}
