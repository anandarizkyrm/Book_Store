@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Tambah Buku')])

@section('content')
<div class="content">
  <div class="card">
    <div class="card-header card-header-primary">
      <h4 class="card-title">{{ __('Tambah Buku') }}</h4>
      <p class="card-category">{{ __('Tambah buku pada form di bawah') }}</p>
    </div>
    <div style="padding : 40px;" class="container-fluid">
      <div class="row">
        <div class="col-md-12">
         
          <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data" >
            {{csrf_field()}}
            <div>
              <label for="name" class="col-form-label">Title <span class="text-danger">*</span></label>
              <input id="name" type="text" name="name" placeholder="Masukan Judul Buku"  value="{{old('name')}}" class="form-control">
              @error('name')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

    
    
            <div style="margin-top : 20px;">
              <label for="summary " class="col-form-label">Summary</label>
              <input value="{{old('summary')}}"  id="summary" type="hidden" name="summary">
              <trix-editor input="summary"></trix-editor>
              @error('summary')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
    
            <div style="margin-top : 20px;">
              <label for="description" class="col-form-label">Description</label>
              <input value="{{old('description')}}"  id="description" type="hidden" name="description">
              <trix-editor input="description"></trix-editor>
              @error('description')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
    
  
            <div style="margin-top : 20px;">
              <label for="category_id">Category <span class="text-danger">*</span></label>
              <select name="category_id" id="cat_id" class="form-control">
                  <option value="">-- Pilih Kategori Buku --</option>
                  @foreach($category as $key=>$cat_data)
                      <option value='{{$cat_data->id}}'>{{$cat_data->name}}</option>
                  @endforeach
              </select>
              @error('category_id')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
    
      
            <div style="margin-top : 20px;">
              <label for="price" class="col-form-label">Harga (Rp.) <span class="text-danger">*</span></label>
              <input maxlength="6" id="price" type="number" name="price" placeholder="Enter price"  value="{{old('price')}}" class="form-control">
              @error('price')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
    
    
            <div style="margin-top : 20px;">
              <label for="publisher_id">Penerbit</label>
              {{-- {{$publishers}} --}}
    
              <select name="publisher_id" class="form-control">
                  <option value="">-- Pilih Penerbit --</option>
                 @foreach($publishers as $publisher)
                  <option value="{{$publisher->id}}">{{$publisher->name}}</option>
                 @endforeach
              </select>
              @error('publisher_id')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div style="margin-top : 20px;">
              <label for="writer_id">Penulis</label>
              {{-- {{$publishers}} --}}
    
              <select name="writer_id" class="form-control">
                  <option value="">-- Pilih Penulis --</option>
                 @foreach($writers as $writer)
                  <option value="{{$writer->id}}">{{$writer->name}}</option>
                 @endforeach
              </select>
              @error('writer_id') 
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div style="margin-top : 20px;">
              <label for="stock">Jumlah <span class="text-danger">*</span></label>
              <input id="quantity" type="number" name="stock" min="0" placeholder="Masukan Jumlah"  value="{{old('stock')}}" class="form-control">
              @error('stock')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div style="margin-top : 20px;">
              <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
              <div class="input-group" >
                  {{-- <span class="text-white ">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary btn-sm">
                      <i class="fa fa-picture-o"></i> Choose
                      </a>
                  </span> --}}
              <input id="thumbnail" class="form-control" type="file" name="image" value="{{old('image')}}">
            </div>
            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
              @error('image')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            
            <div style="margin-top : 20px;">
              <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
              <select name="status" class="form-control">
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
              </select>
              @error('status')
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