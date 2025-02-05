<?php

namespace Yuges\Commentable\Models;

use Yuges\Commentable\Traits\HasOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $id
 * 
 * @property-read ?\Illuminate\Support\Carbon $created_at
 * @property-read ?\Illuminate\Support\Carbon $updated_at
 */
class Comment extends Model
{
    use
        HasUlids,
        HasOrder,
        HasFactory,
        SoftDeletes;

    protected $table = 'comments';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'extra' => 'array',
        ];
    }
}
