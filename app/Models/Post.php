<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @throws \Exception
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @throws \Exception
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%');
        });
    }

  

    public function scopeWithCategory($query)
    {
        $query->with('category');
    }
    public function scopeWithUser($query)
    {
        $query->with('user');
    }
    public function scopeWithComments($query)
    {
        $query->with('comments');
    }
    public function scopeWithCommentsCount($query)
    {
        $query->withCount('comments');
    }
    public function scopeWithCommentsAndUser($query)
    {
        $query->with(['comments.user']);
    }
}
