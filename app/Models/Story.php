<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Story extends Model
{
    use HasFactory;

    protected $appends = ['rated', 'is_favorite', 'preference'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('totals', function (Builder $builder) {
            $builder->select('*', DB::raw('SUM(total_views + total_favorites + total_pages) as total'));
            $builder->groupBy('id');
        });
    }

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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'preference'
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
        $ret = null;
        if($this->preference) $ret = $this->preference->is_favorite;
        return $ret;
    }

    public function getRatedAttribute($value){
        $ret = null;
        if($this->preference) $ret = $this->preference->rate;
        return $ret;
    }
}
