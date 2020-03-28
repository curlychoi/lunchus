<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'category_id', 'name', 'walk_time', 'memo', 'url',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param Builder $query
     * @param string $inputQuery
     * @return Builder
     */
    public  function scopeSearch($query, $inputQuery = '')
    {
        return $query->when($inputQuery, function ($query, $inputQuery) {
            return $query->where('name', 'like', '%' . $inputQuery . '%');
        });

    }
}
