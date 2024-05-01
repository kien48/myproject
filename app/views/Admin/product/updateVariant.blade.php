@extends('layout.main')
@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Cập nhật biến thể sản phẩm</h3>

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

        <form method="post" action="{{route('admin/update-variant')}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="id_pro" class="form-label">ID sản phẩm:</label>
                        <input type="text" class="form-control" name="pro_id" value="{{$oneVariant[0]->idpro}}" disabled>
                        <input type="hidden" class="form-control" name="pro_id" value="{{$oneVariant[0]->idpro}}" >
                        <input type="hidden" class="form-control" name="id" value="{{$oneVariant[0]->id}}" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="color" class="form-label">Màu:</label>
                        <select  class="form-select" id="size" name="color" >
                            <option value="">- Lựa chọn -</option>
                                <option value="Đỏ" {{ $oneVariant[0]->color == 'Đỏ' ? 'selected' : '' }}>Đỏ</option>
                                <option value="Xanh" {{ $oneVariant[0]->color == 'Xanh' ? 'selected' : '' }}>Xanh</option>
                                <option value="Đen" {{ $oneVariant[0]->color == 'Đen' ? 'selected' : '' }}>Đen</option>
                                <option value="Trắng" {{ $oneVariant[0]->color == 'Trắng' ? 'selected' : '' }}>Trắng</option>
                                <option value="Hồng" {{ $oneVariant[0]->color == 'Hồng' ? 'selected' : '' }}>Hồng</option>
                                <option value="Vàng" {{ $oneVariant[0]->color == 'Vàng' ? 'selected' : '' }}>Vàng</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="size" class="form-label">Kích cỡ:</label>
                        <select  class="form-select" id="size" name="size" >
                            <option value="">- Lựa chọn -</option>
                            <option value="S" {{ $oneVariant[0]->size == 'S' ? 'selected' : '' }}>S</option>
                            <option value="M" {{ $oneVariant[0]->size == 'M' ? 'selected' : '' }}>M</option>
                            <option value="L" {{ $oneVariant[0]->size == 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ $oneVariant[0]->size == 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ $oneVariant[0]->size == 'XXL' ? 'selected' : '' }}>XXL</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quantity" class="form-label">Số lượng:</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" value="{{$oneVariant[0]->quantity}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{route('admin/variant/'.$oneVariant[0]->idpro)}}" class="btn btn-outline-secondary" style="margin-right: 10px;"><i class="fa-solid fa-arrow-left"></i> Danh sách</a>
                <button type="submit" name="add" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Cập nhật</button>
            </div>
        </form>
    </div>
@endsection

