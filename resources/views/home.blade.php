@extends('adminlte::page')

@section('title','Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{__('Dashboard')}}</div>
                        <div class="card-body">
                            @if($user->roles_id == 1)
                                Anda login sebagai admin
                            @else
                                Anda login sebagai user
                            @endif
                        </div> 
                    </div>
                </div>
            </div>
            @if($user->roles_id == 1)
            
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $selesai }}</h3>
                            <p>Penasi Selesai</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-fw fa-check"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $proses }}</h3>
                            <p>Penasi  Proses</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-fw fa-solid fa-clock"></i>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $ditolak }}</h3>
                            <p>Penasi Ditolak</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-fw fa-solid fa-exclamation"></i>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $users }}</h3>
                            <p>User</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-fw fa-users"></i>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Area Chart</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 394px;" width="788" height="500" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <canvas id="myChart"></canvas>
            </div>
            @endif
            <input type="text" value="{{ $pengaduan }}" id="jml_pengaduan">
            <input type="text" value="{{ $aspirasi }}" id="jml_aspirasi">
        </div>
    </div>
@endsection

@section('footer')

@endsection

@section('css')
    
@endsection

@section('js')
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script>
    var pengaduan = document.getElementById("jml_pengaduan").value;
    var aspirasi = document.getElementById("jml_aspirasi").value;
    console.log(aspirasi);
    console.log(pengaduan);
</script>
<script>  

var ctx = document.getElementById("areaChart").getContext('2d');

var areaChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','Agustus','September','Oktober','November','Desember'],
        datasets: [{
            label: 'pengaduan', // Name the series
            data: [0,	0,	0,	0,	0,	0,	0, pengaduan, 0, 0, 0, 0],  // Specify the data values array
            fill: true,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        },
                  {
            label: 'aspirasi', // Name the series
            data: [0,	0,	0,	0,	0,	0, 0,  aspirasi, 0, 0, 0, 0], // Specify the data values array
            fill: true,
            borderColor: '#4CAF50', // Add custom color border (Line)
            backgroundColor: '#4CAF50', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]
    },
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});

//   $(function () {
//     //--------------
//     //- AREA CHART -
//     //--------------

//     // Get context with jQuery - using jQuery's .get() method.
//     var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
//     // This will get the first returned node in the jQuery collection.
//     var areaChart       = new Chart(areaChartCanvas)

//     var areaChartData = {
//       labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
//       datasets: [
//         {
//           label               : 'Electronics',
//           fillColor           : 'rgba(210, 214, 222, 1)',
//           strokeColor         : 'rgba(210, 214, 222, 1)',
//           pointColor          : 'rgba(210, 214, 222, 1)',
//           pointStrokeColor    : '#c1c7d1',
//           pointHighlightFill  : '#fff',
//           pointHighlightStroke: 'rgba(220,220,220,1)',
//           data                : [65, 59, 80, 81, 56, 55, 40]
//         },
//         {
//           label               : 'Digital Goods',
//           fillColor           : 'rgba(60,141,188,0.9)',
//           strokeColor         : 'rgba(60,141,188,0.8)',
//           pointColor          : '#3b8bba',
//           pointStrokeColor    : 'rgba(60,141,188,1)',
//           pointHighlightFill  : '#fff',
//           pointHighlightStroke: 'rgba(60,141,188,1)',
//           data                : [28, 48, 40, 19, 86, 27, 90]
//         }
//       ]
//     }

//     var areaChartOptions = {
//       //Boolean - If we should show the scale at all
//       showScale               : true,
//       //Boolean - Whether grid lines are shown across the chart
//       scaleShowGridLines      : false,
//       //String - Colour of the grid lines
//       scaleGridLineColor      : 'rgba(0,0,0,.05)',
//       //Number - Width of the grid lines
//       scaleGridLineWidth      : 1,
//       //Boolean - Whether to show horizontal lines (except X axis)
//       scaleShowHorizontalLines: true,
//       //Boolean - Whether to show vertical lines (except Y axis)
//       scaleShowVerticalLines  : true,
//       //Boolean - Whether the line is curved between points
//       bezierCurve             : true,
//       //Number - Tension of the bezier curve between points
//       bezierCurveTension      : 0.3,
//       //Boolean - Whether to show a dot for each point
//       pointDot                : false,
//       //Number - Radius of each point dot in pixels
//       pointDotRadius          : 4,
//       //Number - Pixel width of point dot stroke
//       pointDotStrokeWidth     : 1,
//       //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
//       pointHitDetectionRadius : 20,
//       //Boolean - Whether to show a stroke for datasets
//       datasetStroke           : true,
//       //Number - Pixel width of dataset stroke
//       datasetStrokeWidth      : 2,
//       //Boolean - Whether to fill the dataset with a color
//       datasetFill             : true,
//       //String - A legend template
//       legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
//       //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
//       maintainAspectRatio     : true,
//       //Boolean - whether to make the chart responsive to window resizing
//       responsive              : true
//     }

//   });
    </script>
@endsection