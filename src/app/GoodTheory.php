<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GoodTheory;

class GoodTheory extends Model
{
    protected $fillable = [
        'theory_id','user_id',
    ];

}
