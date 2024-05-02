@extends("layout.main")

@section("content")

@if(empty($listTop))
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <h1 class="error-code h1 text-warning display-1 mt-5">Không có sản phẩm nào</h1>
                <p class="error-message h3 lead mb-5 mt-2">Vui lòng kiểm tra lại sau</p>
                <a href="{{ route('/') }}" class="btn btn-outline-danger">Quay lại Trang chủ</a>
            </div>
        </div>
    </div>
</div>
@else
<div class="container mt-4">
    <h1 class="h3 text-center mb-4">Top sản phẩm bán chạy</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Số lượng bán</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                @php $key = 1 @endphp
                @foreach($listTop as $product)
                <tr>
                    <td>{{$key++}}</td>
                    <td>{{$product->product_name}}</td>
                    <td>
                        <img src="{{$product->image}}" alt="{{$product->name}}" style="max-width: 100px;">
                    </td>
                    <td>{{$product->total_sold}}</td>
                    <td>{{number_format($product->price)}}đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection