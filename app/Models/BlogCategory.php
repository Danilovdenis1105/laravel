<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use HasFactory, SoftDeletes;

    public const ROOT = 1;

    protected $table = 'blog_categories';

    protected $fillable = [
        'parent_id',
        'slug',
        'title',
        'description',
    ];

    /**
     * Get parent category
     *
     * @return BelongsTo
     */
    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id', 'id');
    }

    /**
     * Accessor
     *
     * @return string
     */
    public function getParentTitleAttribute(): string
    {
        return $this->parentCategory->title
            ?? ($this->isRoot()
                ? 'Core category'
                : '???'
            );
    }

    /**
     * Accessor example
     *
     * @param $value
     * @return array|bool|string|null
     */
    public function getTitleAttribute($value): array|bool|string|null
    {
        return mb_strtoupper($value);
    }

    /**
     * Mutator example
     *
     * @param $value
     * @return void
     */
    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = mb_strtolower($value);
    }

    public function isRoot(): bool
    {
        return $this->id === self::ROOT;
    }
}
