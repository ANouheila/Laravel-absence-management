<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    protected $table = 'professeurs';
    protected $primaryKey = 'id';
    protected $fillable= [
        'nom_prof','prenom_prof',
    ];
}
