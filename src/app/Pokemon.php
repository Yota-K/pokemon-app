<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemons';

    protected $fillable = [
        'pokemon_name',
        'first_type',
        'second_type',
        'characteristic',
        'personality',
        'belongings',
        'user_id',
        'theory_id',
    ];
}
