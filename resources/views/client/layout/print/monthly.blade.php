<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Laporan Data Buku Terjual</title>
</head>
<body>
    <div class="">
        <div class="text-center">
            <h3>Laporan Data Buku Terjual</h3>
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
                        <th >Jumlah Terjual</th>
                        <th >Total Harga</th>
                        <th >Tanggal Terjual</th>
                      
          
                    </tr>
                </thead>
                <tbody>
                    @foreach ($book as $book)
                    <tr style="font-size: 12px;">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$book->book->name}}</td>
                        <td>{{$book->book->category->name}}</td>
                        <td>{{$book->quantity}} </td>
                        <td>Rp. {{number_format($book->amount,2)}} </td>
                        <td>{{$book->updated_at}}</td>
                      
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