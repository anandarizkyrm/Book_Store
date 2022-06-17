@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Tambah Pengguna Aplikasi')])

@section('content')
<div class="content">
  <div class="card">
    <div class="card-header card-header-primary">
      <h4 class="card-title">{{ __('Tambah Pengguna Aplikasi') }}</h4>
      <p class="card-category">{{ __('Tambah Pengguna Aplikasi pada form di bawah') }}</p>
    </div>
    <div style="padding : 40px;" class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{route('user.store')}}" enctype="multipart/form-data" >
            {{csrf_field()}}
            <div>
              <label for="name" class="col-form-label">Nama <span class="text-danger">*</span></label>
              <input id="name" type="text" name="name" placeholder="Masukan Nama"  value="{{old('name')}}" class="form-control">
              @error('name')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div>
                <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
                <input id="email" type="text" name="email" placeholder="Masukan Email"  value="{{old('email')}}" class="form-control">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>


            <div>
                <label for="password" class="col-form-label">Password <span class="text-danger">*</span></label>
                <input id="password" type="password" name="password" placeholder="Masukan Password"  value="{{old('password')}}" class="form-control">
                @error('password')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
  
            <div style="margin-top : 20px;">
              <label for="role">Category <span class="text-danger">*</span></label>
              <select name="role" class="form-control">
                  <option value="">-- Pilih Role --</option>
                  <option value='admin'>Admin</option>
                  <option value='user'>User</option>
                  <option value='su'>Super User</option>
              </select>
              @error('role')
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