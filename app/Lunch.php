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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scopeIsTodayRestaurant($query, $restaurantId)
    {
        return $query->where('lunch_day', now()->format('Y-m-d'))
            ->where('restaurant_id', $restaurantId);
    }

    public function scopeToday($query)
    {
        return $query->where('lunch_day', now()->format('Y-m-d'))
            ->orderBy('id');
    }
}
