<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Laporan Data Buku</title>
</head>
<body>
    <div class="">
        <div class="text-center">
            <h3>Laporan Data Pengguna</h3>
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
                        <th >Judul Buku</th>
                        <th >Kategori</th>
                        <th >Penulis</th>
                        <th >Penerbit</th>
                        <th >Harga Satuan</th>
                        <th >Total</th>
                        <th >Stok</th>
          
                    </tr>
                </thead>
                <tbody>
                    @foreach ($book as $book)
                    <tr style="font-size: 12px;">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$book->name}}</td>
                        <td>{{$book->category['name']}}</td>
                        <td >{{$book->writer['name']}}</td>
                        <td >{{$book->publisher['name']}}</td>
                 
                        <td >{{number_format($book->price,2)}}</td>
                        <td >{{number_format($book->price * $book->stock,2)}}</td>
                        <td>{{$book->stock}}</td>
                      
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