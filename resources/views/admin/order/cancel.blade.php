
@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Cancel_Order')])

@section('content')
 <!-- DataTales Example -->
 <div style="padding: 40px; padding-top : 70px">
 <div class="card shadow mb-4">

    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Daftar Order Yang Dicancel</h6>
      <form style="width: 28rem; display : flex; justify-content : center ; align-items : center;" class="float-right" method="post" action="{{route('cancel.order.pdf')}}"  >
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
              <th>Nama</th>
              <th>Email</th>
              <th>Jumlah</th>
              <th>Alasan Pembatalan</th>
              <th>Total Amount</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Order No.</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Jumlah</th>
              <th>Alasan Pembatalan</th>
              <th>Total Amount</th>
              <th>Tanggal</th>
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
                    <td class="text-center">{{$order->cancel_reason ? $order->cancel_reason : '-'}}</td>
                    <td>Rp. {{number_format($order->total_amount,2)}}</td>
                    <td>
                        {{$order->updated_at}}
                    </td>
                  
                </tr>  
            @endforeach
          </tbody>
        </table>
    
        @else
        <h6 class="text-center">No orders found!!! Please order some products</h6>
        @endif
      </div>
    </div>
</div>
</div>
@endsection

@push('css')
  <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
  <script src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
    
    $('#product-dataTable').DataTable();

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

 


