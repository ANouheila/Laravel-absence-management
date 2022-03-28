<?php

namespace App\Http\Controllers;

use App\Etudiant;
use App\Seance;

use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index()
    {
        $seances=Seance::all();
        return view('absence.appel',compact('seances'));
    }
    public function create()
    {
        return view('absence.create');
    }

   
    public function search() {
        $filiere=request()->input('filiere');
        $seances=Seance::all();
        $niveau=request()->input('niveau');
        $section=request()->input('section');
        $date=request()->input('date_seance');
        $etudiants=Etudiant::where('filiere','like',"%$filiere%")
        ->where('niveau','like',"%$niveau%")
        ->where('section','like',"%$section%")
        ->paginate(5);
        return view('absence.appel',compact('etudiants','seances'))
        ->with('i',(request()->input('page',1) -1)*5);
    }

    
}
