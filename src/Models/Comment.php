<?php

namespace Yuges\Commentable\Models;

use Carbon\Carbon;
use Yuges\Package\Models\Model;
use Yuges\Commentable\Traits\HasOrder;
use Yuges\Commentable\Traits\HasComments;
use Yuges\Commentable\Traits\HasCommentator;
use Yuges\Commentable\Traits\HasCommentable;
use Yuges\Commentable\Interfaces\Commentable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property array $extra
 * @property string $text
 * @property string $original
 * 
 * @property-read ?Carbon $approved_at
 */
class Comment extends Model implements Commentable
{
    use
        HasUlids,
        HasOrder,
        HasFactory,
        HasComments,
        HasCommentator,
        HasCommentable;

    protected $table = 'comments';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'extra' => 'array',
            'approved_at' => 'datetime',
        ];
    }
}
