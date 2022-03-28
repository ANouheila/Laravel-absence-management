@extends('absence.layout')
@section('content')
<div class="container">
  <h5 class="bord">Tableau de bord</h5>

  <div class="row stat">
      <div class="col-md-6">
        <canvas id="myChart"></canvas>
        <h4 class="ti">Le nombre d'absences selon l'élement du module</h4>
      </div>
      <div class="col-md-6">
        <canvas id="myChart0"></canvas>
        <h4 class="ti">Le nombre d'absences selon le jour de séance</h4>

      </div>
  </div>

  <div>
  <div class="row stat">
      <div class="col-md-4">
        <canvas id="iagi"></canvas>
        <h4 class="ti">les absences pour la filiére IAGI</h4>

      </div>
      <div class="col-md-4">
        <canvas id="mecanique"></canvas>
        <h4 class="ti">Les absences pour la filiére Mécanique</h4>

      </div>
      <div class="col-md-4">
        <canvas id="api"></canvas>
        <h4 class="ti">Les absences pour les API</h4>

      </div>
      
  </div>

  <div>
 

</div>
<script>

var labels={!! json_encode($dates,JSON_HEX_TAG) !!};
var data0={
  labels:labels,
  datasets:[{
    label:'les absences selon la séance',
    data:{!! json_encode($nombresAbsents,JSON_HEX_TAG) !!},
    fill:false,
    borderColor:'#067FD0',
    tension:0.1
  }]
};
var configur={
  type:'line',
  data:data0,
};


var myChart0 = new Chart(
    document.getElementById('myChart0'),
    configur
  );



  var labels ={!! json_encode($labels6,JSON_HEX_TAG) !!};
  const data = {
  labels: labels,
  datasets: [{
    label: 'Developpement mobile',
    data: {!! json_encode($nombres6,JSON_HEX_TAG) !!},
    backgroundColor: [
      '#1AA7EC',
      '#797EF6',
      '#4ADEDE'
    ],
    borderColor: [
      '#1AA7EC',
      '#797EF6',
      '#4ADEDE'
    ],
    borderWidth: 1
  }]
};

  
const config = {
  type: 'bar',
  data: data,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
};

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );



 //pour la filiere IAGI
  const data1 = {
  labels: ['absent','présent'],
  datasets: [{
    label: 'iagi',
    data: {!! json_encode($nombres1,JSON_HEX_TAG) !!},
    backgroundColor: [
      '#1AA7EC',
      '#797EF6',
      '#4ADEDE'
    ],
    hoverOffset: 4
  }]
};

const configuration1 = {
  type: 'doughnut',
  data: data1,
};
 
const myChart1 = new Chart(
    document.getElementById('iagi'),
    configuration1
  );




 //pour la filiere Mecanique
  const data2 = {
  labels: {!! json_encode($labels2,JSON_HEX_TAG) !!},
  datasets: [{
    label: 'Mecanique',
    data: {!! json_encode($nombres2,JSON_HEX_TAG) !!},
    backgroundColor: [
      '#1AA7EC',
      '#797EF6',
      '#4ADEDE'
    ],
    hoverOffset: 4
  }]
};

const configuration2 = {
  type: 'doughnut',
  data: data2,
};
 
const myChart2 = new Chart(
    document.getElementById('mecanique'),
    configuration1
  );




 //pour la filiere Industrielle
  const data3 = {
  labels: {!!json_encode($labels3,JSON_HEX_TAG) !!},
  datasets: [{
    label: 'Industrielle',
    data: {!! json_encode($nombres3,JSON_HEX_TAG) !!},
    backgroundColor: [
      '#1AA7EC',
      '#797EF6',
      '#4ADEDE'
    ],
    hoverOffset: 4
  }]
};

const configuration3 = {
  type: 'doughnut',
  data: data3,
};
 
const myChart3 = new Chart(
    document.getElementById('industrielle'),
    configuration3
  );




 //pour la filiere APi I
  const data4 = {
  labels: {!! json_encode($labels4,JSON_HEX_TAG) !!},
  datasets: [{
    label: 'API I',
    data: {!! json_encode($nombres4,JSON_HEX_TAG) !!},
    backgroundColor: [
      '#1AA7EC',
      '#797EF6',
      '#4ADEDE'
    ],
    hoverOffset: 4
  }]
};

const configuration4 = {
  type: 'doughnut',
  data: data4,
};
 
const myChart4 = new Chart(
    document.getElementById('api'),
    configuration4
  );




 //pour la filiere API II
  const data5 = {
  labels: {!! json_encode($labels5,JSON_HEX_TAG) !!},
  datasets: [{
    label: 'API II',
    data: {!! json_encode($nombres5,JSON_HEX_TAG) !!},
    backgroundColor: [
      '#1AA7EC',
      '#797EF6',
      '#4ADEDE'
    ],
    hoverOffset: 4
  }]
};

const configuration5 = {
  type: 'doughnut',
  data: data5,
};
 
const myChart5= new Chart(
    document.getElementById('apiI'),
    configuration5
  );














</script>



@endsection