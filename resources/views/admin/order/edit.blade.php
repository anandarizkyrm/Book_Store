@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Tambah Buku')])

@section('content')
<div class="content">
  <div class="card">
    <div class="card-header card-header-primary">
      <h4 class="card-title">{{ __('Edit Order Status') }}</h4>
      <p class="card-category">{{ __('Edit Order Status pada form di bawah') }}</p>
    </div>
    <div style="padding : 40px;" class="container-fluid">
      <div class="row">
        <div class="col-md-12">
         
          <form action="{{route('order.update',$order->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
              <label for="status">Status :</label>
              <select name="status" id="" class="form-control">
                <option value="new" {{($order->status=='delivered' || $order->status=="processing" || $order->status=="cancel") ? 'disabled' : ''}}  {{(($order->status=='new')? 'selected' : '')}}>New</option>
                <option value="processing" {{($order->status=='delivered'|| $order->status=="cancel") ? 'disabled' : ''}}  {{(($order->status=='processing')? 'selected' : '')}}>process</option>
                <option value="delivered" {{($order->status=="cancelled") ? 'disabled' : ''}}  {{(($order->status=='delivered')? 'selected' : '')}}>Delivered</option>
                <option value="cancelled" {{($order->status=='delivered') ? 'disabled' : ''}}  {{(($order->status=='cancelled')? 'selected' : '')}}>Cancel</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    
    </div>
  </div>
</div>
@endsection

@push('js')

<script>
  document.addEventListener('trix-file-accept', function(e) {
    e.preventDefault();
  });
</script>

@endpush