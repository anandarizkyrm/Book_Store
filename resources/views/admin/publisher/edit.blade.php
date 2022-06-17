@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Edit Penerbit')])

@section('content')
<div class="content">
  <div class="card">
    <div class="card-header card-header-primary">
      <h4 class="card-title">{{ __('Edit Penerbit') }}</h4>
      <p class="card-category">{{ __('Edit Penerbit pada form di bawah') }}</p>
    </div>
    <div style="padding : 40px;" class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{route('publisher.update', $publisher->id)}}"  >
            @csrf 
            @method('PATCH')
            <div>
              <label for="name" class="col-form-label">Nama <span class="text-danger">*</span></label>
              <input id="name" type="text" name="name" placeholder="Masukan Nama"  value="{{$publisher->name}}" class="form-control">
              @error('name')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div>
              <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
              <input id="email" type="text" name="email" placeholder="Masukan Email"  value="{{$publisher->email}}" class="form-control">
              @error('email')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div>
              <label for="address" class="col-form-label">Alamat <span class="text-danger">*</span></label>
              <input id="address" type="text" name="address" placeholder="Masukan Email"  value="{{$publisher->address}}" class="form-control">
              @error('address')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

         
            <div style="margin-top : 20px;"mb-3">
              <button type="reset" class="btn btn-warning">Reset</button>
               <button class="btn btn-success" type="submit">Submit</button>
            </div>
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