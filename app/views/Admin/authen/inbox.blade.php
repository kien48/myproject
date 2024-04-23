@extends('layout.main')
@section("content")
    <style>


        .container {
            padding-top: 30px;
        }

        .card-header {
            background-color: #4267B2;
            color: white;
            font-weight: bold;
        }

        .card-body {
            padding: 0;
        }

        .list-group-item {
            border: none;
            cursor: pointer;
        }

        .nav_link {
            text-decoration: none;
            color: white;
        }

        .nav_link:hover {
            color: blue;
        }


    </style>
    <div class="container">
        <h3 class="text-center">Trang hỗ trợ khách hàng</h3>

        <div class="row mt-3">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Danh sách người gửi tin nhắn
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                           @foreach($listConversation as $con)
                                <div class="mt-3">
                                    <a class="nav_link" href="{{route('admin/chat/'.$con->id_user)}}" ><li class="list-group-item">{{$con->username}} <span class="badge bg-danger rounded-pill position-absolute" style="top: -5px; right: -8px;">1</span></li></a>
                                </div>
                           @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection