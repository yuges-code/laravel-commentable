<?php

namespace Yuges\Commentable\Traits;

use Yuges\Commentable\Interfaces\Commentator;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $commentator_id
 * @property string $commentator_type
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
