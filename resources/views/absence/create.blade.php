@extends('absence.layout')
@section('content')
      <div class="card">
          <div class="card-header">Ajouter une seance</div>
          <div class="card-body">
              <form action="{{ url('seance') }}" method="post">
                {!! csrf_field() !!}
                <label>Date seance:</label></br>
                <input type="date" name="date_seance"  class="form-control">
                <label>Intitule Module:</label></br>
                <input type="text" name="intitule" id="address" class="form-control">
                <label>Type de Seance:</label></br>
                <select name="type_seance" class="form-select">
                      <option value="cours">Cours</option>
                      <option value="TD" selected>TD</option>
                      <option value="TP">TP</option>
                </select>

                <label>Niveau:</label></br>
                <select name="niveau" class="form-select">
                    <option value="API1">API1</option>
                    <option value="API2" selected>API2</option>
                    <option value="CI1">CI1</option>
                    <option value="CI2">CI2</option>
                    <option value="CI3">CI3</option>
                </select>

               <label>filiére:</label></br>
                <select name="filiere" class="form-select">
                    <option value="API">API</option>
                    <option value="IAGI" selected>IAGI</option>
                    <option value="GEM">GEM</option>
                    <option value="GI">GI</option>
                    <option value="MSEI">MSEI</option>
                </select>
                
                
                <label>Section:</label></br>
                <select class="form-select" name="section">
                      <option value="sectionA">section A</option>
                      <option value="sectionB" selected>section B</option>
                      <option value="sectionC">section C </option>
                      <option value="cycle">cycle ingénieur</option>
                </select>        
                <input type="submit" value="Ajouter" class="enregister"></br>
            </form>
      </div>

@endsection