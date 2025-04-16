<?php

// app/Models/Comment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'publication_id',
        'user_id',
        'user_response_id',
        'content',
        'number_of_likes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }

    public function responseTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_response_id');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(CommentRating::class);
    }
}
