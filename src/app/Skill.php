<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'skill_name_1',
        'skill_name_2',
        'skill_name_3',
        'skill_name_4',
        'pokemon_id',
        'theory_id',
    ];
}
