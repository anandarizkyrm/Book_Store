

@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Order')])

@section('content')
 <!-- DataTales Example -->
 <div style="padding: 40px; padding-top : 70px">
 <div class="card shadow mb-4">

    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Daftar Order</h6>
      <form style="width: 28rem; display : flex; justify-content : center ; align-items : center;" class="float-right" method="post" action="{{route('allorder.pdf')}}"  >
        {{csrf_field()}}
          <label style="padding: 0px; margin : 0px; color :rgb(36, 36, 36)" for="">Dari</label>
          <input  style="margin: 5px; color : rgb(112, 112, 112); border : 1px solid rgb(226, 226, 226) border-radius : 10px;" type="date" name="start" />
          <label  style="padding: 0px; margin : 0px; color :rgb(36, 36, 36)" for="">-</label>
          <input  style="margin: 5px; color : rgb(112, 112, 112); border : 1px solid rgb(179, 179, 179) border-radius : 10px;"  type="date" name="end" />
          <button type="submit" class="btn btn-primary btn-sm float-right"><i class="material-icons">download</i> Unduh  PDF</button>
      </form>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($orders)>0)
        <table class="table" id="product-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Order No.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Quantity</th>
              <th>Shipping Charge</th>
              <th>Total Amount</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Order No.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Quantity</th>
              <th>Shipping Charge</th>
              <th>Total Amount</th>
              <th>Status</th>
              <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($orders as $order)  
            @php
                $shipping_charge=DB::table('shipping')->where('id',$order->shipping_id)->pluck('price');
            @endphp 
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->first_name}} {{$order->last_name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->quantity}}</td>
                    <td> Rp. {{number_format($order->ongkir,2)}}</td>
                    <td>Rp. {{number_format($order->total_amount,2)}}</td>
                    <td>
                        @if($order->status=='new')
                          <span class="badge badge-primary">{{$order->status}}</span>
                        @elseif($order->status=='process')
                          <span class="badge badge-warning">{{$order->status}}</span>
                        @elseif($order->status=='delivered')
                          <span class="badge badge-success">{{$order->status}}</span>
                        @else
                          <span class="badge badge-danger">{{$order->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('order.show',$order->id)}}" class="btn btn-info btn-sm btn-round btn-just-icon "  data-toggle="tooltip" title="view" data-placement="bottom"><i class="material-icons">info</i></a>
                        <a href="{{route('order.edit',$order->id)}}" class="btn btn-warning btn-sm btn-round btn-just-icon "  data-toggle="tooltip" title="edit" data-placement="bottom"><i class="material-icons">warning</i></a>
                        <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                          @csrf 
                          @method('delete')
                              <button class="btn btn-danger btn-sm btn-round btn-just-icon dltBtn" data-id={{$order->id}}  data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="material-icons">delete</i></button>
                        </form>
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$orders->links()}}</span>
        @else
        <h6 class="text-center">No orders found!!! Please order some products</h6>
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
        transform: scale(5);
      }
  </style>
@endpush

@push('js')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>

      $('#product-dataTable').DataTable( {
        "scrollX": false
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[10,11,12]
                }
            ]
        } );

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

 


