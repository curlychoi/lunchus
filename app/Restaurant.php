<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'category_id', 'name', 'walk_time', 'memo', 'url', 'user_id',
    ];

    protected static function booted()
    {
        static::updated(function ($restaurant) {
            RestaurantHistory::create([
                'restaurant_id' => $restaurant->id,
                'user_id' => auth()->id(),
                'memo' => RestaurantHistory::makeHistory($restaurant)
            ]);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histories()
    {
        return $this->hasMany(RestaurantHistory::class)->latest('id');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param Builder $query
     * @param string $inputQuery
     * @return Builder
     */
    public function scopeSearch($query, $inputQuery = '')
    {
        return $query->when($inputQuery, function ($query, $inputQuery) {
            return $query->where('name', 'like', '%' . $inputQuery . '%');
        });
    }
}
