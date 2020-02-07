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

    public function type_index(array $types ,string $get_type) {
        $index = 0;

        foreach ($types as $key => $type) {
            if ($type === $get_type) $index += $key;
        }

        return $index;
    }
}
