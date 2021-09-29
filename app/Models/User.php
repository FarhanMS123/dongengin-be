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
    protected $appends = ['favorites', 'rank', 'history'];

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
    ];

    public function getHistoryAttribute(){
        return Story::select('stories.*')->join('preferences', 'stories.id', '=', 'preferences.story_id')
                ->where('preferences.user_id', '=', $this->id)
                ->where('preferences.is_favorite', '=', true)
                ->orderBy('accessed_at', 'desc');
    }

    public function getFavoritesAttribute(){
        return Story::select('stories.*')->join('preferences', 'stories.id', '=', 'preferences.story_id')
                ->where('preferences.user_id', '=', $this->id)
                ->where('preferences.is_favorite', '=', true);
        // $u = $this;
        // return Story::select('stories.*')->join('preferences', function($join) use($u){
        //     $join->on('stories.id', '=', 'preferences.story_id')
        //          ->where('preferences.user_id', '=', $u->id)
        //          ->where('preferences.is_favorite', '=', true);
        // });
    }

    public function getRankAttribute(){
        return DB::table('ranking')->where('id', '=', $this->id)->get();
    }
}
