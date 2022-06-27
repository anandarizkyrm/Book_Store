@extends('user-dashboard.main', ['activePage' => 'profile', 'titlePage' => __('Review')])


@section('content')
<div style="padding : 20px;">

  <div style=" margin-top : 60px;" class="card">
    <h5 class="card-header">Review Edit</h5>
    <div class="card-body">
      <form action="{{route('user.productreview.update',$review->id)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="name">Review By:</label>
          <input type="text" disabled class="form-control" value="{{$review->userInfo->name}}">
        </div>
        <div class="form-group">
          <label for="review">Review</label>
        <textarea name="review" id="" cols="20" rows="10" class="form-control">{{$review->review}}</textarea>
        </div>
     
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
</div>
@endsection

@push('css')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }
</style>
@endpush