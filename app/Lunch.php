<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lunch extends Model
{
    protected $fillable = [
        'lunch_day', 'restaurant_id', 'user_id'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class)->withTrashed();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'lunch_user')
            ->orderBy('lunch_user.id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public static function isJoinToday($userId)
    {
        return DB::table('lunch_user')
            ->where('lunch_day', now()->format('Y-m-d'))
            ->where('user_id', $userId)
            ->exists();
    }

    public static function dropTodayLunch($userId)
    {
        return DB::table('lunch_user')
            ->where('lunch_day', now()->format('Y-m-d'))
            ->where('user_id', $userId)
            ->delete();
    }
}

