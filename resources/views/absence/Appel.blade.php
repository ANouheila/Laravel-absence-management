

@extends('absence.layout')
@section('content')
        <form action="{{route('seances.search')}}" class="barre">
            <div class="row recherche">
           
                <div class="col-md-4">
                    <label>Niveau:</label></br>
                    <select name="niveau" class="form-select">
                        <option value="api1">API1</option>
                        <option value="api2">API2</option>
                        <option value="ci1">CI1</option>
                        <option value="ci2" SELECTED>CI2</option>
                        <option value="ci3">CI3</option>
                    </select>
                </div>
                <div class="col-md-4">
                <label>filiére:</label></br>
                    <select name="filiere" class="form-select">
                        <option value="api">API</option>
                        <option value="iagi" selected>IAGI</option>
                        <option value="gem">GEM</option>
                        <option value="gi">GI</option>
                        <option value="msei">MSEI</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Section:</label></br>
                    <select class="form-select" name="section">
                        <option value="sectionA">section A</option>
                        <option value="sectionB" selected>section B</option>
                        <option value="sectionC">section C </option>
                        <option value="cycle" selected>cycle ingénieur</option>
                    </select> 
                </div>

            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                <button type="submit" class="find"><i class="fa fa-search" aria-hidden="true"></i>
                 rechercher</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="card  absent">
                    <div class="card-header">Etudiants</div>
                    <div class="card-body">
                        <div class="table-responsive">            
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th>cne</th>
                                        <th>nom</th>
                                        <th>prenom</th>
                                        <th>niveau</th>
                                        <th>filière</th>
                                        <th>section</th>
                                        <th >Présent/Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($etudiants))
                                    @foreach($etudiants as $etudiant)
                                    <form method="POST" action="{{ url('absence') }}">
                                    {{ csrf_field() }}                                       
                                    <tr>
                                        <td>{{ $etudiant->cne }}</td>
                                            <td>{{ $etudiant->nom }}</td>
                                            <td>{{ $etudiant->prenom}}</td>
                                            <td>{{ $etudiant->niveau}}</td>
                                            <td>{{ $etudiant->filiere }}</td>
                                            <td>{{ $etudiant->section }}</td>                                 
                                            <td>
                                           <input type="radio" value="1"  name={{ $etudiant->id }} checked> <img src="https://img.icons8.com/ios-filled/50/000000/attendance-mark.png" class="ab"/>
                                            <input type="radio"  value="0" name={{ $etudiant->id }} ><img src="https://img.icons8.com/ios-glyphs/30/000000/remove-user-male.png" class="ab"/>      
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif               
                                </tbody>
                            </table>
                            <div class="az">
                                        <label>Élement du module:</label></br>
                                        <select class="form-select" name="element">
                                            @foreach($seances as $seance)
                                                <option value="{{ $seance->intitule}}">{{ $seance->intitule}}</option>
                                            @endforeach

                                        </select> 
                                    </div> 
                            <button type="submit" class="envoyer">Envoyer</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

@endsection