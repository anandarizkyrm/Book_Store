<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Laporan Data Pesanan</title>
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
                        <th >Nama Pemesan</th>
                        <th >Nomor Order</th>
                        <th >Jumlah </th>
                        <th >Harga (Rp.)</th>
                        <th >Ongkir (Rp.)</th>
                      
                        <th >Total Harga (Rp.)</th>
                        <th >Tanggal Pesan</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $order)
                    <tr style="font-size: 12px;">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$order->first_name}}</td>
                        <td>{{$order->order_number}}</td>
                        <td>{{$order->quantity}}</td>
                        <td >{{number_format($order->total_amount,2)}}</td>
                        <td >{{number_format($order->ongkir,2)}}</td>
                 
                        <td >{{number_format($order->total_amount + $order->ongkir,2)}}</td>

                        <td>{{$order->created_at}}</td>
                      
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