@extends('layout.main')
@section("content")
    <style>
        .container {
            padding-top: 30px;
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

    </style>
    <div class="container">
        <h3 class="text-center">Trang hỗ trợ khách hàng</h3>

        <div class="row mt-3">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-warning">
                        Danh sách người gửi tin nhắn mới nhất
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($listConversation as $con)
                                    <?php
                                    // Kiểm tra xem id_user có tồn tại trong mảng $dem không
                                    $count = 0;
                                    foreach($_SESSION['$dem'] as $item) {
                                        if ($item->id_user == $con->id_user) {
                                            $count++;
                                        }
                                    }
                                    ?>
                                <div class="mt-3">
                                    <a class="nav_link" href="{{ route('admin/chat/'.$con->id_user) }}">
                                        <li class="list-group-item">
                                            {{$con->username}}
                                            <span class="badge bg-danger rounded-pill position-absolute" style="top: -5px; right: -8px;">
                    {{$count}}
                </span>
                                        </li>
                                    </a>
                                </div>
                            @endforeach


                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-warning">
                        Danh sách người gửi tin nhắn
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($listUser as $con)
                                <div class="mt-3">
                                    <a class="nav_link" href="{{ route('admin/chat/'.$con->id) }}">
                                        <li class="list-group-item">
                                            {{$con->username}}
                                        </li>
                                    </a>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection