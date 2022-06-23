@extends('user-dashboard.main', ['activePage' => 'profile', 'titlePage' => __('Cancel')])


@section('content')

<div style="padding : 30px; margin-top : 30px;">
  <div class="container-fluid card">
    @include('user-dashboard.layouts.notification')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Pembatalan Pesanan</h1>
    </div>
    <div class="row p-4">
        <form method="post" action="{{route('user.cancel.order', $id)}}" >
            @csrf
            @method('patch')
            <div style="width : 40rem;" class="form-group">
                <label for="exampleFormControlTextarea1">Alasan Pembatalan</label>
                <textarea name="cancel_reason" class="form-control" id="exampleFormControlTextarea1" rows="4" style="width: 100%;" ></textarea>
              </div>
            <button class="btn btn-success btn-sm" type="submit">Kirim</button>
        </form>  
    </div>

</div>
</div>

@endsection
