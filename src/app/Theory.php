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
}
