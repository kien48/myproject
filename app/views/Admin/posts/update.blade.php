@extends("layout.main")
@section('content')
    <div class="container mt-3">
        <!-- Page Heading -->
        <h3 class="text-center mb-3">Trang cập nhật bài viết</h3>
        @if(isset($_SESSION['errors']) && isset($_GET['msg']))
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($_SESSION['errors'] as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(isset($_SESSION['success']) && isset($_GET['msg']))
            <div class="alert alert-success" role="alert">
                <span>{{$_SESSION['success']}}</span>
            </div>
        @endif
        <form action="{{route('admin/post/update')}}" method="post" enctype="multipart/form-data">
            <div class="form-group mt-3">
                <label for="title">Tiêu đề bài viết</label>
                <textarea name="title" id="title" cols="30" rows="3" class="form-control" name="tilte">
                {{$listOne->tilte}}
                </textarea>
                <input type="hidden" name="id" value="{{$listOne->id}}">
            </div>
            <div class="form-group mt-3">
                <label for="image">Hình ảnh</label>
                <input type="file" name="image" id="image" class="form-control">
                <div class="mt-2 mb-2">
                    <img src="../../../public/img/{{$listOne->image}}" alt="" height="300px">
                </div>
            </div>
            <input type="hidden" name="author" value="{{$_SESSION['admin']->username}}">
            <div class="form-group mt-3">
                <label for="content">Nội dung bài viết</label>
                <textarea id="editor" contenteditable="true" class="form-control" name="text">{{$listOne->text}}</textarea>
            </div>
            <div class="form-group mt-3 text-center">
                <a href="#" class="btn btn-secondary">Quay lại</a>
                <button type="submit" class="btn btn-primary" name="submit">Cập nhật</button>
            </div>
        </form>

@endsection

