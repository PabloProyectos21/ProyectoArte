<?php

// app/Models/CommentRating.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentRating extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = null;
    protected $fillable = ['user_id', 'comment_id', 'like'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}

