<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    public $rating = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'thumbnail',
        'route',
        'description',
        'categories',
        'total_views',
        'total_favorites',
        'total_pages',
    ];
}
