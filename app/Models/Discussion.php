<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use function PHPUnit\Framework\isNull;

class Discussion extends Model
{
    use HasFactory;

    public function scopeOrderByPinned($query)
    {
        $query->orderBy('pinned_at', 'desc');
    }

    public function isPinned()
    {
        return !is_null($this->pinned_at);
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function topic() :BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function posts() :HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function post() :HasOne
    {
        return $this->hasone(Post::class)
        ->whereNull('parent_id');
    }
}
