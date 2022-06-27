<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Laporan Data Pesanan Yang Dibatalkan</title>
</head>
<body>

    <div class="">
        <div class="text-center">
            <h3>Laporan Data Pesanan</h3>
            <div style="display: flex;" class="d-flex">
                <p><span style="font-weight: 900;">Dari Tanggal</span> : {{$start}} <span style="font-weight: 900;">  Sampai Tanggal</span> : {{$end}}</p>
            </div>
            {{-- header --}}
        </div>
        <div class="">
            <table class="table table-bordered">
                <thead>
                    <tr style="font-size: 12px;">
                        <th >No</th>
                        <th>Order No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jumlah</th>
                        <th>Alasan Pembatalan</th>
                        <th>Total Amount</th>
                        <th>Tanggal</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $order)
                    <tr style="font-size: 12px;">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$order->order_number}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->quantity}}</td>
                        <td class="text-center">{{$order->cancel_reason ? $order->cancel_reason : '-'}}</td>
                        <td >{{number_format($order->total_amount + $order->ongkir,2)}}</td>
                        <td>{{$order->updated_at}}</td>
                      
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
            {{-- body --}}
        </div>
        <div class="">
            {{-- footer --}}
        </div>
    </div>
</body>
</html>