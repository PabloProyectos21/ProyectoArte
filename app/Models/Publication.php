<?php

namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image_route',
        'title',
        'description',
        'number_of_ratings',
        'clicks',
        'category',
        'publication_date',
    ];



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function favoredByUsers()
    {
        return $this->belongsToMany(User::class, 'user_publication_favorite')->withTimestamps();
    }

    public function ratings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PublicationRating::class, 'publication_id');
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'publication_ratings');
    }

}
