@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Edit Diskon')])

@section('content')
<div class="content">
  <div class="card">
    <div class="card-header card-header-primary">
      <h4 class="card-title">{{ __('Edit Diskon') }}</h4>
      <p class="card-category">{{ __('Edit Diskon pada form di bawah') }}</p>
    </div>
    <div style="padding : 40px;" class="container-fluid">
      <div class="row">
        <div class="col-md-12">
         
          <form action="{{route('discount.edit',$product->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
            <label for="discount">Diskon :</label>
            <input name="discount" type="number" value="{{$product->discount}}"/>
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