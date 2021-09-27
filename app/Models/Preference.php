<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "user_id",
        "status",       // Nullable
        "is_favorite",  // false
        "category",     // Nullable
        "rate",         // Nullable
        "story_id"      // Nullable
    ];
}
