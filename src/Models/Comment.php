<?php

namespace Yuges\Commentable\Models;

use Carbon\Carbon;
use Yuges\Commentable\Traits\HasTable;
use Yuges\Commentable\Traits\HasOrder;
use Illuminate\Database\Eloquent\Model;
use Yuges\Commentable\Traits\HasComments;
use Yuges\Commentable\Traits\HasCommentator;
use Yuges\Commentable\Traits\HasCommentable;
use Yuges\Commentable\Interfaces\Commentable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $id
 * 
 * @property array $extra
 * @property string $text
 * @property string $original
 * 
 * @property ?Carbon $approved_at
 * @property-read ?Carbon $created_at
 * @property-read ?Carbon $updated_at
 * @property-read ?Carbon $deleted_at
 */
class Comment extends Model implements Commentable
{
    use
        HasUlids,
        HasTable,
        HasOrder,
        HasFactory,
        SoftDeletes,
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
