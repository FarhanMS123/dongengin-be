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

    protected $appends = ['rated', 'is_favorite', 'preference', 'status', 'accessed_at'];

    /**
     * The "booted" method of the model.
     *
     * Because it calls Auth each creation, it wouldn't efficient.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('totals', function (Builder $builder) {
            $builder->select('stories.*',
                            DB::raw('SUM(total_views + total_favorites + total_pages) as total'));
            $builder->groupBy('stories.id');

            // if(Auth::check()){
            //     $u = Auth::user();
            //     $builder->select('stories.*',
            //                      DB::raw('SUM(total_views + total_favorites + total_pages) as total'),
            //                      DB::raw('preferences.rate as rated'),
            //                     'preferences.is_favorite');
            //     $builder->leftJoin('preferences', 'stories.id', '=', 'preferences.story_id');
            //     $builder->where('user_id', '=', $u->id);
            //     $builder->groupBy('stories.id');
            // }
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
        'rating',
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

    public function getCategoriesAttribute($value){
        return json_decode($value);
    }

    public function setCategoriesAttribute($value){
        return json_encode($value);
    }

    protected $_preference = null;
    protected function getPreferenceAttribute(){
        if($this->_preference == null && Auth::check()){
            $u = Auth::user();
            // $this->_preference = [$this->id, $u->id];
            $this->_preference = Preference::where('story_id', '=', $this->id)->where('user_id', '=', $u->id)->get();
        }
        return $this->_preference;
    }

    public function getIsFavoriteAttribute($value){
        $ret = null;
        // $ret = $this->preference;
        if($this->preference && $this->preference->count() > 0){
            $ret = $this->preference[0]->is_favorite;
        }
        return $ret;
    }

    public function getRatedAttribute($value){
        $ret = null;
        // $ret = $this->preference;
        if($this->preference && $this->preference->count() > 0)
            $ret = $this->preference[0]->rate;
        return $ret;
    }

    public function getStatusAttribute($value){
        $ret = null;
        // $ret = $this->preference;
        if($this->preference && $this->preference->count() > 0)
            $ret = $this->preference[0]->status;
        return $ret;
    }

    public function getAccessedAtAttribute($value){
        $ret = null;
        // $ret = $this->preference;
        if($this->preference && $this->preference->count() > 0)
            $ret = $this->preference[0]->accessed_at;
        return $ret;
    }

    public function updateStoryRanking(){
        $this->rating = Preference::where('story_id', '=', $this->id)->avg('rate');
        $this->total_favorites = Preference::where('story_id', '=', $this->id)->sum('is_favorite');
        $this->save();
        $this->refresh();
    }
}
