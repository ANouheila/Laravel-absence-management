@extends('absence.layout')
@section('content')
<div class="cabsent">
    <h4 class="list-absence">Liste des absences</h4>
    {{ csrf_field() }}
            <div class="row x">
                <div class="col-md-3">
                <form action="{{ route('absence.find') }}">
                    <label>Date de la séance:</label></br>
                    <input type="date" name="date_seance"  class="form-control re">
                </div>
                <div class="col-md-1">
                <button type="submit" class="icon"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
                </form>
                <div class="col-md-3">
                <form action="{{ route('absence.search') }}">
                    <label>CNE:</label></br>
                    <input type="text" name="cne" id="address" class="form-control">
                </div>
                <div class="col-md-1">
                <button type="submit" class="icon"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
                </form>
                <div class="col-md-4">
                <form action="{{ route('absence.csv') }}" >
                          <input type="submit" class="form-control btn1" value="Exporter vers csv">
                </form>
                </div>

            </div>
    <table class="table">
                                <thead>
                                    <tr>
                                       <th>date de la séance</th>
                                       <th>Intitulé de l'élement</th>
                                        <th>Nom </th>
                                        <th>prenom </th>
                                        <th>CNE</th>                                
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($absences as $absence)
                                {{ csrf_field() }}

                                    <tr>
                                        <td>{{ $absence->seance->date_seance }}</td>
                                        <td>{{ $absence->seance->intitule}}</td>
                                        <td>{{ $absence->etudiant->nom}}</td>
                                        <td>{{ $absence->etudiant->prenom}}</td>
                                        <td>{{ $absence->etudiant->cne}}</td>          
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
</div>
@endsection