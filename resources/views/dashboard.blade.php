@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">book</i>
              </div>
              <p class="card-category">Judul Buku</p>
              <h3 class="card-title">{{\App\Models\Book::countActiveBook()}}
                <small>Judul</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">info</i> Total Judul Buku
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Stok Buku</p>
              <h3 class="card-title">{{\App\Models\Book::countStockBook()}}
                <small>Stok</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">info</i> Total Stok Buku Yang Tersedia  
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">category</i>
              </div>
              <p class="card-category">Total Kategori</p>
              <h3 class="card-title">{{\App\Models\Category::countActiveCategory()}}
            </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">info</i> Total Kategori Tersedia
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">people</i>
              </div>
              <p class="card-category">Pengguna</p>
              <h3 class="card-title">{{\App\Models\User::getTotalUser()}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">info</i> Total Pengguna
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