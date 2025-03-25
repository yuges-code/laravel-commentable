<?php

namespace Yuges\Commentable\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Commentator
{
    public function comments(): MorphMany;
}
