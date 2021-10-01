<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['favorites', 'rank', 'history', 'preference'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fullname',
        'username',
        'birthdate',
        'password',
        'poins',
        'coins',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'preference'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'birthdate' => 'date',
    ];

    protected $_preference = null;
    protected function getPreferenceAttribute(){
        if($this->_preference == null){
            $this->_preference = Story::select('stories.*')
                        ->join('preferences', 'stories.id', '=', 'preferences.story_id')
                        ->where('preferences.user_id', '=', $this->id);

            // $u = $this;
            // return Story::select('stories.*')->join('preferences', function($join) use($u){
            //     $join->on('stories.id', '=', 'preferences.story_id')
            //          ->where('preferences.user_id', '=', $u->id)
            //          ->where('preferences.is_favorite', '=', true);
            // });
        }
        return $this->_preference;
    }

    public function getHistoryAttribute(){
        if($this->preference == null) return null;
        return $this->preference->orderBy('accessed_at', 'desc')->get();
    }

    public function getFavoritesAttribute(){
        if($this->preference == null) return null;
        return $this->preference->where('preferences.is_favorite', '=', true)->get();
    }

    public function getRankAttribute(){
        return DB::table('ranking')->where('id', '=', $this->id)->get()[0]->rank;
    }

    // public function getCardsAttribute($value){
    //     return collect(json_decode($value));
    // }

    // public function setCardsAttribute($value){
    //     return collect($value)->toJson();
    // }
}
