@extends("layout.main")
@section("content")
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="text-center">
                        <h1 class="error-code h1 text-warning display-1 mt-5">Thanh toán thành công</h1>
                        <p class="error-message h3 lead mb-5 mt-2">Cảm ơn bạn đã đặt hàng</p>
                        <a href="{{ route('/') }}" class="btn btn-outline-danger">Trở lại trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
@endsection

