@extends("layout.main")
@section("content")
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <h1 class="error-code h1 text-danger display-1 mt-5">Đặt hàng thất bại</h1>
                    <p class="error-message h3 lead mb-5 mt-2">Vui lòng đặt lại</p>
                    <a href="{{ route('/') }}" class="btn btn-outline-danger">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection