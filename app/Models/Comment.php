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
        'parent_comment_id',
    ];
    public function ratings()
    {
        return $this->hasMany(CommentRating::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    public function likedBy(User $user)
    {
        return $this->ratings()->where('user_id', $user->id)->exists();
    }


    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function responseTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_response_id');
    }


}
