<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $table = 'etudiants';
    protected $primaryKey = 'id';
    protected $fillable= [
        'nom','prenom','cne','niveau','filiere','section'
    ];

    public function absences() {
        return $this->hasMany(Absence::class);
    }
}
