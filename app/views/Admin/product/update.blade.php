@extends('layout.main')
@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Cập nhật sản phẩm</h3>
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
        <form method="post" action="{{route('admin/product/update')}}" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <span class="form-label">Tên:</span>
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="hidden" name="status" value="{{$product->status}}">
                    <input type="text" class="form-control" name="name" value="{{$product->name}}">
                </div>
                <div class="col-md-6">
                    <span class="form-label">Giá nhập:</span>
                    <input type="text" class="form-control" name="import_price"  value="{{$product->import_price}}" disabled>
                    <input type="hidden" class="form-control" name="import_price"  value="{{$product->import_price}}" >
                </div>
                <div class="col-md-6">
                    <span class="form-label">Giá bán:</span>
                    <input type="text" class="form-control" name="price"  value="{{$product->price}}">
                </div>
                <div class="col-md-6">
                    <span class="form-label">Ảnh 1:</span>
                    <div class="border">
                        <input type="file" class="form-control" name="image">
                        <div class="text-center mt-3 mb-3">
                            <img src="../../../{{$product->image}}" alt="" height="80px">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <span class="form-label">Ảnh 2:</span>
                    <div class="border">
                        <input type="file" class="form-control" name="image2">
                        <div class="text-center mt-3 mb-3">
                            <img src="../../../{{$product->image2}}" alt="" height="80px">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <span class="form-label">Danh mục:</span>
                    <select id="" class="form-select" name="id_ct">
                        <option value="0">Chọn</option>
                        @foreach($listCategory as $cate)
                            <option value="{{$cate->id}}" @php if($cate->id == $product->id_ct){
                                                             echo 'selected';
                                                          }else{
                                                              echo '';
                                                          } @endphp>{{$cate->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-md-6">
                    <span class="form-label">Mô tả:</span>
                    <textarea name="description" id="description" cols="10" rows="5" class="form-control"  >{{$product->description}}</textarea>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{route('admin/list-product/1')}}" class="btn btn-outline-secondary" style="margin-right: 10px;"><i class="fa-solid fa-arrow-left"></i> Danh
                    sách</a>
                <button type="submit" name="update" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Cập nhật</button>

            </div>
        </form>
    </div>
@endsection

