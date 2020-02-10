<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theory extends Model
{
    protected $fillable = [
        'title',
        'content',
        'description',
        'user_id',
    ];

    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    public function pokemon() 
    {
        return $this->hasOne('App\Pokemon')->withDefault();
    }

    public function skill() 
    {
        return $this->hasOne('App\Skill');
    }

    public function good() {
        return $this->hasMany('App\GoodTheory');
    }

    public function good_count(string $theory_id) 
    {
        return $this->good()->where('theory_id', $theory_id)->count();
    }

    public function is_good(string $theory_id, string $user_id) 
    {
        return $this->good()
                    ->where('theory_id', $theory_id)
                    ->where('user_id', $user_id)
                    ->exists();
    }
}
