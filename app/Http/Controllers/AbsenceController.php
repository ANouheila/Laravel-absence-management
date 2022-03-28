<?php

namespace App\Http\Controllers;

use App\Absence;
use App\Seance;
use App\Etudiant;

use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function index()
    {
        //on recupere les enregistrements ou il y'a des absences
        $absences=Absence::where('present','=',0)
        
        ->paginate(8);  
        $seances=Seance::all();
        return view('absence.liste',compact('absences','seances'));
    }
    
    public function store(Request $request)
    {
        $date = date('Y-m-d');
        $seances=Seance::where('date_seance','=',"$date")
        ->where('intitule',"=","$request->element")
        ->get();
        foreach($request->all() as $cle=>$value) {
            if($cle=="_token" ) {
            }else if ($cle=="element") {

            }
            else {
                Absence::create([
                    'present'     => $value,
                    'etudiant_id'      => $cle,
                    'seance_id'         => $seances[0]->id,
                ]);
            }
         
        }
        return redirect('/liste');
    
    }
    public function searchByCne() {
       $x=request()->input('cne');
       //on recupere les cne des etudiants 
       $etudiants=Etudiant::where('cne','like',"%$x%")
       ->paginate(8);  
       $absences=array();
       foreach(absence::all() as $item) {
          if($item->etudiant->cne == request()->input('cne') && $item->present==0) {
               array_push($absences,$item);
          }
       }
       $seances=Seance::all();
       return view('absence.liste',compact('absences','seances'))
       ->with('i',(request()->input('page',1) -1)*8);

    }
    function exportToCsv() {
        $filename='Absences.csv';
        $seances=absence::where('present','=',0)->get();
        $headers=array("Content-type" =>"text/csv",
        "Content-Disposition" =>"atachement ;filename=$filename",
        "Pragma" =>"no-cache",
        "Cache-Control" =>"must-revalidate ,post-check=0,pre-check=0",
        "Expires"=>"0");
        $columns=array('dateSeance','intitule','nom','prenom','Cne','niveau','filiere','section');
        $callback=function() use($seances,$columns) {
            $file=fopen('php://output','W');
            $delimeter=";";
            fputcsv($file,$columns,$delimeter);

            foreach($seances as $sean) {
                $row['dateSeance']=$sean->seance->date_seance;
                $row['intitule']=$sean->seance->intitule;
                $row['nom']=$sean->etudiant->nom;
                $row['prenom']=$sean->etudiant->prenom;
                $row['Cne']=$sean->etudiant->cne;
                $row['niveau']=$sean->etudiant->niveau;
                $row['filiere']=$sean->etudiant->filiere;
                $row['section']=$sean->etudiant->section;
                fputcsv($file,array($row['dateSeance'],$row['intitule'],$row['nom'],$row['prenom'],$row['Cne'],$row['niveau'],$row['filiere'],$row['section']),$delimeter);
            }
            fclose($file);
        };
        
      return response()->stream($callback,200,$headers);
    }

    public function searchByDate() {
        $x=request()->input('date_seance');
//on recupere la liste des absences ,ensuite on cherche si la date de l'absence correspond à celle cherhce
$absences=array();       
    foreach(absence::all() as $item) {
        if($item->seance->date_seance == $x && $item->present==0) {
            array_push($absences,$item);
        }
    }
    $seances::all();
    return view('absence.liste',compact('absences','seances'))
       ->with('i',(request()->input('page',1) -1)*8);
    }
    
}
