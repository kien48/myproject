@extends("layout.main")

@section("content")
    <style>
        .message-container {
            height: 400px;
            overflow-y: auto;
        }

        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 10px;
        }

        .received-message {
            background-color: #f0f0f0;
        }

        .sent-message {
            background-color: #007bff;
            color: white;
            align-self: flex-end;
        }

        .timestamp {
            font-size: 0.8rem;
            color: #051b11;
        }
        .timestamp1 {
            font-size: 0.8rem;
            color: white;
        }

        .card-footer {
            background-color: #f0f0f0;
            border-top: 1px solid #ddd;
            padding: 15px;
        }

    </style>

    <div class="container mt-5">
        <h1 class="mb-4">Trang tin nhắn</h1>
        <div class="row">
            <div class="col-md-12">
                <!-- Khu vực hiển thị tin nhắn -->
                <div class="card">
                    <div class="card-header">
                        Tin nhắn với Admin
                    </div>
                    @if(isset($checkBox) && count($checkBox) > 0 )
                        <div class="card-body message-container">
                            @php
                                // Sắp xếp mảng $list theo ngày tăng dần
                                usort($list, function($a, $b) {
                                    return strtotime($b->date) - strtotime($a->date);
                                });
                            @endphp

                            @foreach ($list as $message)
                                @if ($message->sender_id == 4)
                                    <!-- Tin nhắn từ người admin -->
                                    <div class="message received-message ">
                                        <h5>Admin</h5><p>{{ $message->content }}</p>

                                        <span class="timestamp">{{ date("h:i A", strtotime($message->date)) }}</span>
                                        <h6>
                                            @if(isset($message->status) && $message->status == 0)
                                                đã xem
                                            @elseif(isset($message->status) && $message->status == 1)
                                                chưa xem
                                            @endif
                                        </h6>
                                    </div>
                                @else
                                    <!-- Tin nhắn của bạn -->
                                    <div class="message sent-message">
                                        <h5>Tôi</h5>
                                        <p>{{ $message->content }}</p>
                                        <span class="timestamp1">{{ date("h:i A", strtotime($message->date)) }}</span>
                                        <h6>
                                            @if(isset($message->status) && $message->status == 0)
                                                đã xem
                                            @else
                                                chưa xem
                                            @endif
                                        </h6>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <!-- Form nhập tin nhắn mới -->
                            <form action="{{route('send')}}" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Nhập tin nhắn..." name="text">
                                    <input type="hidden" name="conversation_id" value="{{$checkBox[0]->id}}">
                                    <input type="hidden" name="id_user" value="{{$_SESSION['user']->id}}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary" name="submit">Gửi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <form action="{{route('add-box')}}" method="post">
                            <div class="text-center mt-3">
                                <input type="hidden" name="id_user" value="{{$_SESSION['user']->id}}">
                                <button class="btn btn-primary" name="submit">Thêm đoạn chat</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
