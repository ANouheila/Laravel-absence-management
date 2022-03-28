<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    protected $table = 'seances';
    protected $primaryKey = 'id';
    protected $fillable= [
        'date_seance','type_seance','intitule','niveau','filiere','section',
    ];
    public function absences() {
        return $this->hasMany(Absence::class);
    }
}
