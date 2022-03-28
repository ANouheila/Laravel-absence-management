<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $table = 'absences';
    protected $primaryKey = 'id';
    protected $fillable= [
        'present','etudiant_id','seance_id'
    ];
    public function etudiant() {
        return $this->belongsTo(Etudiant::class);
    }
    public function seance() {
        return $this->belongsTo(Seance::class);
    }
}
