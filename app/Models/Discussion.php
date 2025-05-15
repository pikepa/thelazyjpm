<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Discussion extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'slug',
    ];

    public function toSearchableArray()
    {
        return $this->only('id', 'title');
    }

    protected static function booted()
    {
        static::created(function ($discussion) {
            $discussion->update(['slug' => $discussion->title]);
        });
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = $this->id.'-'.Str::slug($value);
    }

    public function scopeOrderByPinned($query)
    {
        $query->orderBy('pinned_at', 'desc');
    }

    public function scopeOrderByLastPost($query)
    {
        $query->orderBy(
            Post::select('created_at')
            ->whereColumn('posts.discussion_id', 'discussions.id')
            ->latest()
            ->take(1),
            'desc'
        );
    }

    public function isPinned()
    {
        return ! is_null($this->pinned_at);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function latestPost(): HasOne
    {
        return $this->hasOne(Post::class)
            ->latestOfMany();
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Post::class)
        ->whereNotNull('parent_id');
    }

    // this is the top post ie without a parent
    public function post(): HasOne
    {
        return $this->hasone(Post::class)
            ->whereNull('parent_id');
    }

    public function participants(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Post::class, 'discussion_id', 'id', 'id', 'user_id')
        ->distinct();
    }

    public function solution(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'solution_post_id');
    }
}
