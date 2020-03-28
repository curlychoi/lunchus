<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lunch extends Model
{
    protected $fillable = [
        'lunch_day', 'restaurant_id', 'user_id'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function scopeTodayRestaurant($query, $restaurantId)
    {
        return $query->where('lunch_day', now()->format('Y-m-d'))
            ->where('restaurant_id', $restaurantId);
    }
}
