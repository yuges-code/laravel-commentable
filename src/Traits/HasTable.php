<?php

namespace Yuges\Commentable\Traits;

use TypeError;
use Illuminate\Database\Eloquent\Model;

trait HasTable
{
    public static function getTableName(): string
    {
        $model = new static;

        if (! $model instanceof Model) {
            throw new TypeError('Traitable class dont instance of eloquent model');
        }

        return $model->getTable();
    }
}
