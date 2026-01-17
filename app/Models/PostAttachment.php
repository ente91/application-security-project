<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'original_name',
        'path',
        'mime',
        'size',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
