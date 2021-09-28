<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Story extends Model
{
    use HasFactory;

    public $rated = 0;
    public $is_favorite = false;

    protected $preference = null;

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

    protected $_preference = null;
    protected function getPreferenceAttribute(){
        if($this->_preference == null && Auth::check()){
            $u = Auth::user();
            $this->_preference = Preference::where('story_id', '=', $this->id)->where('user_id', '=', $u->id)->get();
        }
        return $this->_preference;
    }

    public function getIsFavoriteAttribute($value){
        return $this->preference->is_favorite;
    }

    public function getRatedAttribute($value){
        return $this->preference->rate;
        // return Preference::where('story_id', '=', $this->id)->avg('rate');
    }
}
