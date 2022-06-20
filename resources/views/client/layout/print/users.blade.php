<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Laporan Data Pengguna</title>
</head>
<body>
    <div class="">
        <div class="text-center">
            <h3>Laporan Data Pengguna</h3>
            <div style="display: flex;" class="d-flex">
                <p><span style="font-weight: 900;">Tanggal Daftar</span> : {{$start}} <span style="font-weight: 900;">  Sampai Tanggal</span> : {{$end}}</p>
            </div>
            {{-- header --}}
        </div>
        <div class="">
            <table class="table table-bordered">
                <thead>
                    <tr style="font-size: 12px;">
                        <th >No</th>
                        <th >Nama Pengguna</th>
                        <th >Email</th>
                        {{-- <th> Foto</th> --}}
                        <th >Tanggal Dibuat</th>
          
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $user)
                    <tr style="font-size: 12px;">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        {{-- <td>
                            @if($user->images)
                           
                                 <img  src="{{asset('/storage/images/'.$user->images)}}" class="img-fluid rounded-circle" alt="{{$user->images}}">
                            @else
                                <img src="{{asset('img/avatar.png')}}" class="img-fluid rounded-circle" alt="avatar.png">
                            @endif
        
                         </td> --}}
                        <td>{{$user->created_at}}</td>
                      
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