@extends('layouts.app', ['activePage' => 'finance', 'titlePage' => __('Keuangan')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div  class="card card-stats" >
              <div style="padding : 10px;">
                  <div class=" card-header card-header-success card-header-icon">
                        <p class="card-category">Pendapatan</p>
                    </div>
                    <h3 class="card-title">Rp. {{\App\Models\Order::totalIncome()}} </h3>
                </div>
                    <div class="card-footer">
              <div class="stats">
                <i class="material-icons">info</i> Total Seluruh Pendapatan
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div  class="card card-stats" >
                <div style="padding : 10px;">
                    <div class=" card-header card-header-success card-header-icon">
                          <p class="card-category">Pendapatan Hari Ini</p>
                      </div>
                      <h3 class="card-title">Rp. {{\App\Models\Order::totalIncomeToday()}} </h3>
                  </div>
                      <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">info</i> Total Pendapatan Hari Ini
                </div>
              </div>
            </div>
          </div>    
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div  class="card card-stats" >
                <div style="padding : 10px;">
                    <div class=" card-header card-header-success card-header-icon">
                          <p class="card-category">Pendapatan Bulan Ini</p>
                      </div>
                      <h3 class="card-title">Rp. {{\App\Models\Order::totalIncomeThisMonth()}} </h3>
                  </div>
                      <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">info</i> Total Pedapatan bulan Ini
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div  class="card card-stats" >
                <div style="padding : 10px;">
                    <div class=" card-header card-header-success card-header-icon">
                          <p class="card-category">Pendapatan Tahun Ini</p>
                      </div>
                      <h3 class="card-title">Rp. {{\App\Models\Order::totalIncome()}} </h3>
                  </div>
                      <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">info</i> Total Tahun Ini
                </div>
              </div>
            </div>
          </div>
      </div>
      <div style="padding: 12px;" class="row">
        <div id="myAreaChart" style="width: 100%; height: 500px"></div>
      </div>
  
    </div>
    
  </div>
  
@endsection

@push('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    const url = "{{route('book.order.income')}}";
    // var data = new google.visualization.DataTable();
    // data.addColumn('number', 'Day');
    //   data.addColumn('number', 'Guardians of the Galaxy');
    //   data.addColumn('number', 'The Avengers');
    //   data.addColumn('number', 'Transformers: Age of Extinction');

    axios.get(url)
              .then(function (response) {
                const data_keys = Object.keys(response.data);
                const data_values = Object.values(response.data);
                const arrayToDataTable = [['Month', 'Income']]
                
                for (let i = 0; i < data_keys.length; i++) {
                  arrayToDataTable.push([data_keys[i], data_values[i]]);
                }

                var data = google.visualization.arrayToDataTable(arrayToDataTable);

                 var options = {
                   
                  title: 'Pendapatan Perbulan (Rupiah)',
                  curveType: 'function',
                  chartArea: {width: '80%', height: '50%'},
                  legend: { position: 'bottom' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('myAreaChart'));
              
                chart.draw(data, options);
              }
              )

                
   

   
  }
</script>
@endpush