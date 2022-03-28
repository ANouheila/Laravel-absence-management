<?php

namespace App\Http\Controllers;

use App\Seance;
use App\Absence;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SeanceController extends Controller
{

        //retourna la page de gerer les seances ,la liste des seances d'un professeur
    public function index()
    {
        $seances=seance::all();
        return view('absence.index',compact('seances'));
    }
    
    //afin d'ajouter une nouvelle seance on retourne le formulaire
    public function create()
    {
        return view('absence.create');
    }
    //exporter vers CSV
    public function exportToCsvA()
    {
        $filename='seances.csv';
        $seances=seance::all();
        $headers=array("Content-type" =>"text/csv",
        "Content-Disposition" =>"atachement ;filename=$filename",
        "Pragma" =>"no-cache",
        "Cache-Control" =>"must-revalidate ,post-check=0,pre-check=0",
        "Expires"=>"0");
        $columns=array('id','dateSeance','TypeSeance','Intitule','niveau','filiere','section');
        $callback=function() use($seances,$columns) {
            $file=fopen('php://output','W');
            $delimeter=";";
            fputcsv($file,$columns,$delimeter);
            foreach($seances as $seance) {
                $row['id']=$seance->id;
                $row['dateSeance']=$seance->date_seance;
                $row['intitule']=$seance->intitule;
                $row['type_seance']=$seance->type_seance;
                $row['niveau']=$seance->niveau;
                $row['filiere']=$seance->filiere;
                $row['section']=$seance->section;


                fputcsv($file,array($row['id'],$row['dateSeance'],$row['intitule'],$row['type_seance'],$row['niveau'],$row['filiere'],$row['section']),$delimeter);

            }
            fclose($file);
        };
        
      return response()->stream($callback,200,$headers);
    }
    //afin de stocker une nouvelle seance
    public function store(Request $request)
    {
        $request->validate([
            'date_seance'=>'required',
            'type_seance'=>'required',
            'intitule'=>'required',
            'niveau'=>'required',
            'filiere'=>'required',
            'section'=>'required',
        ]);
        Seance::create($request->all());
        return redirect('/seance')
        ->with('success','la séance est ajoutée avec succés');
    }  
    
    public function statistiques() {
        $nombresAbsents=array();
        $seances=absence::all();
        $dates=array();
        $labels1=array();
        $nombres1=array();
        //pour juste les iagi
        $varia2=DB::table('absences')
            ->join('etudiants', 'absences.etudiant_id', '=', 'etudiants.id')
            ->select('etudiants.filiere','present',DB::raw('count(*) as total'))->where('etudiants.filiere','iagi')
            ->groupBy('filiere','present')
            ->get();
        foreach($varia2 as $cle=>$value) {
            array_push($labels1,$value->present);
            array_push($nombres1,$value->total);
            }
        
        //pour juste les mecaniques
        $labels2=array();
        $nombres2=array();
        $varia2=DB::table('absences')
        ->join('etudiants', 'absences.etudiant_id', '=', 'etudiants.id')
        ->select('etudiants.filiere','present',DB::raw('count(*) as total'))->where('etudiants.filiere','mecanique')
        ->groupBy('filiere','present')
        ->get();
    foreach($varia2 as $cle=>$value) {
        array_push($labels2,$value->present);
        array_push($nombres2,$value->total);
        }
        
                
        //pour juste les Industrielles
        $labels3=array();
        $nombres3=array();
        $varia2=DB::table('absences')
        ->join('etudiants', 'absences.etudiant_id', '=', 'etudiants.id')
        ->select('etudiants.filiere','present',DB::raw('count(*) as total'))->where('etudiants.filiere','industrielle')
        ->groupBy('filiere','present')
        ->get();
    foreach($varia2 as $cle=>$value) {
        array_push($labels3,$value->present);
        array_push($nombres3,$value->total);
        }
    

        //pour juste les API1
        $labels4=array();
        $nombres4=array();
        $varia2=DB::table('absences')
        ->join('etudiants', 'absences.etudiant_id', '=', 'etudiants.id')
        ->select('etudiants.filiere','present',DB::raw('count(*) as total'))->where('etudiants.filiere','API')
        ->groupBy('filiere','present')
        ->get();
    foreach($varia2 as $cle=>$value) {
        array_push($labels4,$value->present);
        array_push($nombres4,$value->total);
        }
        
                
        //pour juste les API2
        $labels5=array();
        $nombres5=array();
        $varia2=DB::table('absences')
        ->join('etudiants', 'absences.etudiant_id', '=', 'etudiants.id')
        ->select('etudiants.filiere','present',DB::raw('count(*) as total'))->where('etudiants.filiere','api2')
        ->groupBy('filiere','present')
        ->get();
    foreach($varia2 as $cle=>$value) {
        array_push($labels5,$value->present);
        array_push($nombres5,$value->total);
        }
        //pour les statisqtiques en fonction du jour,on compte le nombre d'absence,
        $variab=DB::table('absences')->select('created_at',DB::raw('count(*) as total'))->where('present',0)
        ->groupBy('created_at','present')->get();
        foreach($variab as $cle=>$value) {
          array_push($dates,substr($value->created_at,0,-9));
          array_push($nombresAbsents,$value->total);
        }
        

         //les statisqtiques pour les modules
        $labels6=array();
         $nombres6=array();
         $varia2=DB::table('absences')
         ->join('seances', 'absences.seance_id', '=', 'seances.id')
         ->select('seances.intitule','present',DB::raw('count(*) as total'))->where('present',0)
         ->groupBy('intitule','present')
         ->get();
     foreach($varia2 as $cle=>$value) {
         array_push($labels6,$value->intitule);
         array_push($nombres6,$value->total);
         } 


        return view('absence.dashboard',compact('dates','nombresAbsents','labels1','labels2','labels3','labels4','labels5','labels6','nombres6','nombres1','nombres2','nombres3','nombres4','nombres5'));

    }
 
}