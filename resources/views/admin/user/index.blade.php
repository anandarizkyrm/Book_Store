@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Pengguna')])

@section('content')
 <!-- DataTales Example -->
 <div style="padding: 40px; padding-top : 70px">
 <div class="card shadow mb-4">
  <div class="row">
      {{-- <div class="col-md-12">
         @include('backend.layouts.notification')
      </div> --}}
  </div>
 <div class="card-header py-3">
   <h6 class="m-0 font-weight-bold text-primary float-left">Daftar Pengguna Website</h6>
   <a href="{{route('user.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"> <i class="material-icons">add</i> Add users</a>
 </div>
 <div class="card-body">
   <div class="table-responsive">
     @if(count($users)>0)
     <table class="table" id="users-dataTable" width="100%" cellspacing="0">
       <thead>
         <tr>
           <th>No.</th>
           <th>Nama</th>
           <th>Email</th>
           <th>Foto</th>
           <th>Role</th>
           <th>Action</th>
         </tr>
       </thead>
       <tfoot>
         <tr>
           <th>No.</th>
           <th>Nama</th>
           <th>Email</th>
           <th>Foto</th>
           <th>Role</th>
           <th>Action</th>
           </tr>
       </tfoot>
       <tbody>
         @foreach($users as $users)   
             <tr>
                 <td>{{$loop->index + 1}}</td>
                 <td>{{$users->name}}</td>
                 <td>{{$users->email}}</td>
                 <td>
                    @if($users->image)
                         <img src="{{$user->image}}" class="img-fluid rounded-circle" alt="{{$user->photo}}">
                    @else
                        <img src="{{asset('img/avatar.png')}}" class="img-fluid rounded-circle" alt="avatar.png">
                    @endif

                 </td>
                 <td>
                    @if($users->role == 'admin')
                        <span class="badge badge-primary">{{$users->role}}</span>
                    @else
                        <span class="badge badge-secondary">{{$users->role}}</span>
                    @endif
                 </td>
                
                 <td >
                  {{-- <a href="{{route('product.edit',$users->id)}}" class="btn btn-primary btn-sm" style="height:30px; width:20px;" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="material-icons">edit</i></a> --}}
                  <div class="d-flex">
                    <a href="{{route('product.edit', $users->id)}}" class="btn btn-warning btn-sm btn-round btn-just-icon">
                      <i class="material-icons">edit</i>
                      <div class="ripple-container"></div>
                    </a>
                  <form method="POST" action="{{route('product.destroy',[$users->id])}}">
                    @csrf
                    @method('delete')
                        <button c class="btn btn-danger btn-sm btn-round btn-just-icon" data-id={{$users->id}} data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="material-icons">delete</i></button>
                   </form>
                  </div>
                </td>
                 {{-- Delete Modal --}}
                 {{-- <div class="modal fade" id="delModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$user->id}}Label" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5 class="modal-title" id="#delModal{{$user->id}}Label">Delete user</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>
                         <div class="modal-body">
                           <form method="post" action="{{ route('banners.destroy',$user->id) }}">
                             @csrf 
                             @method('delete')
                             <button type="submit" class="btn btn-danger" style="margin:auto; text-align:center">Parmanent delete user</button>
                           </form>
                         </div>
                       </div>
                     </div>
                 </div> --}}
             </tr>  
         @endforeach
       </tbody>
     </table>
     {{-- <span style="float:right">{{$users->links()}}</span> --}}
     @else
       <h6 class="text-center">No categorys found!!! Please create users</h6>
     @endif
   </div>
 </div>
</div>
</div>
@endsection

@push('styles')
<link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<style>
   div.dataTables_wrapper div.dataTables_paginate{
       display: none;
   }
   .zoom {
     transition: transform .2s; /* Animation */
   }

   .zoom:hover {
     transform: scale(3.2);
   }
</style>
@endpush

@push('scripts')

<!-- Page level plugins -->
<script src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
<script>
   
   $('#users-dataTable').DataTable();

     // Sweet alert

     function deleteData(id){
         
     }
</script>
<script>
   $(document).ready(function(){
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
       $('.dltBtn').click(function(e){
         var form=$(this).closest('form');
           var dataID=$(this).data('id');
           // alert(dataID);
           e.preventDefault();
           swal({
                 title: "Are you sure?",
                 text: "Once deleted, you will not be able to recover this data!",
                 icon: "warning",
                 buttons: true,
                 dangerMode: true,
             })
             .then((willDelete) => {
                 if (willDelete) {
                    form.submit();
                 } else {
                     swal("Your data is safe!");
                 }
             });
       })
   })
</script>
@endpush