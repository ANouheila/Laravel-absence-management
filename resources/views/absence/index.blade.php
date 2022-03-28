@extends('absence.layout')
@section('content')
                <div class="card">
                    <div class="card-header">Mes Séances</div>
                    <div class="card-body">
                        <a href="{{ url('/seance/create') }}" class="btn" title="Add New Student">
                            <i class="fa fa-plus" aria-hidden="true"></i> Ajouter une seance
                        </a>
                        <form action="{{ route('seance.csv') }}" >
                          <input type="submit" id="export" class="form-control btn" value="Exporter vers csv">
                       </div>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            @if ($message=Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>

                            @endif
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>date de la séance</th>
                                        <th>Intitulé de l'élement</th>
                                        <th>Type de la séance</th>
                                        <th>Niveau</th>
                                        <th>Filière</th>
                                        <th>Section</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($seances as $seance)
                                    <tr>
                                    <td>{{ $seance->date_seance}}</td>
                                        <td>{{ $seance->intitule }}</td>
                                        <td>{{ $seance->type_seance}}</td>
                                        <td>{{ $seance->niveau}}</td>
                                        <td>{{ $seance->filiere }}</td>
                                        <td>{{ $seance->section }}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
@endsection