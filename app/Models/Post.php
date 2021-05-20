<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    public function groups(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($post) {
            $post->comments()->each(function($comment) {
                $comment->tags()->delete();
            });
            $post->comments()->delete();
            $post->attachments()->delete();
        });
    }
}
