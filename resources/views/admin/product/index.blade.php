

@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Product')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title">Data Buku</h4>
                <p class="card-category">New employees on 15th September, 2016</p>
              </div>
              <div class="card-body table-responsive">
                {{$dataTable->table()}}
              </div>
            </div>
         
      </div>
    </div>
  </div>
  {!! $dataTable->scripts() !!}
@endsection