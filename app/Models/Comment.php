<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($comment) {
            $comment->tags()->delete();
        });
    }
}
