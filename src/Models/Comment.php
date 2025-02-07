<?php

namespace Yuges\Commentable\Models;

use Carbon\Carbon;
use Yuges\Commentable\Config\Config;
use Yuges\Commentable\Traits\HasOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $id
 * 
 * @property int $commentator_id
 * @property string $commentator_type
 * @property int $commentable_id
 * @property string $commentable_type
 * @property ?string $parent_id
 * @property string $original
 * @property string $text
 * @property array $extra
 * 
 * @property ?Carbon $approved_at
 * @property-read ?Carbon $created_at
 * @property-read ?Carbon $updated_at
 * @property-read ?Carbon $deleted_at
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
            'approved_at' => 'datetime',
        ];
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function commentator(): BelongsTo
    {
        return $this->morphTo();
    }

    public function nested(): HasMany
    {
        return $this->children();
    }

    public function children(): HasMany
    {
        return $this->hasMany(Config::getCommentModel(), 'parent_id');
    }

    public function isParentless(): bool
    {
        return ! $this->parent_id;
    }
}
