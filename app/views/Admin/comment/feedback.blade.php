@extends('layout.main')

@section("content")
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h4>Feedback</h4>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Admin</th>
                        <th>Text</th>
                        <th>Ngày</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->id_user_admin}}</td>
                            <td>{{$item->feedback_text}}</td>
                            <td>{{$item->feedback_date}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h4>Comments</h4>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên người dùng</th>
                        <th>Nội dung</th>
                        <th>Sản phẩm</th>
                        <th>Thời gian</th>
                        <th>Sao</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($one as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->username}}</td>
                            <td>
                                <p data-toggle="tooltip" title="{{$item->content}}">{{$item->content}}</p>
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                @if($item->star != 0)
                                    {{$item->star}} <i class="fa-solid fa-star"></i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <h4>Thêm Feedback</h4>
                <form action="{{ route('admin/comment/feedback/insert') }}" method="POST">
                    <div class="form-group">
                        <label for="text">Text</label>
                        <textarea name="text" id="" cols="15" rows="5" class="form-control" required></textarea>
                        <input type="hidden" class="form-control" id="text" name="id" value="{{$item->id}}">
                        <input type="hidden" class="form-control" id="text" name="id_user_admin" value="{{$_SESSION['admin']->id}}">
                    </div>
                    <div class="text-center mt-4">
                        <a class="btn btn-secondary" href="{{route('admin/comment/1')}}">Danh sách</a>
                        <button type="submit" class="btn btn-primary" name="submit">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
