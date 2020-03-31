<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantHistory extends Model
{
    protected $fillable = [
        'restaurant_id', 'user_id', 'memo',
    ];

    protected $casts = [
        'memo' => 'array',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function makeHistory(Restaurant $restaurant)
    {
        return [
            'category_id' => $restaurant->getOriginal('category_id'),
            'name' => $restaurant->getOriginal('name'),
            'walk_time' => $restaurant->getOriginal('walk_time'),
            'memo' => $restaurant->getOriginal('memo'),
            'url' => $restaurant->getOriginal('url'),
        ];
    }
}
