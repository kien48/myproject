@extends('layout.main')
@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Chào mừng bạn đến với trang admin</h3>
    </div>
    <div class="container">
        <div class="row mt-3 d-flex  justify-content-center">
            <div class="col-md-4 border bg-warning" style="height: 200px">
                <h2 class="text-center mt-2">Tổng tiền hôm nay </h2>
                <h1 class="text-center mt-5">{{ isset($totalToday[0]->total_today) ? number_format($totalToday[0]->total_today) : '0' }}
                    <i class="fa-solid fa-dong-sign"></i></h1>
            </div>
            <div class="col-md-4  border bg-warning" style="height: 200px">
                <h2 class="text-center mt-2">Tổng tiền </h2>
                <h1 class="text-center mt-5">{{ isset($totalAll->total_amount) ? number_format($totalAll->total_amount) : '0' }}
                    <i class="fa-solid fa-dong-sign"></i></h1>
            </div>
            <div class="col-md-4  border bg-warning" style="height: 200px">
                <h2 class="text-center mt-2">Tổng số sản phẩm </h2>
                <h1 class="text-center mt-5">{{ isset($totalProduct->total) ? ($totalProduct->total) : '0' }}
            </div>

            <div class="col-md-4  border bg-success" style="height: 200px">
                <h2 class="text-center mt-2 text-white">Tổng danh mục </h2>
                <h1 class="text-center mt-5 text-white">{{ isset($totalCategory->total) ? ($totalCategory->total) : '0' }}
            </div>
            <div class="col-md-4 border bg-success" style="height: 200px">
                <h2 class="text-center mt-2 text-white">Tổng user</h2>
                <h1 class="text-center mt-5 text-white">{{ isset($totalUser->total) ? ($totalUser->total) : '0' }}
            </div>
            <div class="col-md-4 border bg-success" style="height: 200px">
                <h2 class="text-center mt-2 text-white">Tổng mã giảm giá</h2>
                <h1 class="text-center mt-5 text-white">{{ isset($totalDiscount->total) ? ($totalDiscount->total) : '0' }}
            </div>
            <div class="col-md-4 border bg-success" style="height: 200px">
                <h2 class="text-center mt-2 text-white">Tổng bài viết</h2>
                <h1 class="text-center mt-5 text-white">{{ isset($totalPost->total) ? ($totalPost->total) : '0' }}
            </div>
            <div class="col-md-4 border bg-success" style="height: 200px">
                <h2 class="text-center mt-2 text-white">Tổng đơn hàng thành công</h2>
                <h1 class="text-center mt-5 text-white">{{ isset($totalOrderSucsess->total) ? ($totalOrderSucsess->total) : '0' }}
            </div>
            <div class="col-md-4  border bg-success" style="height: 200px">
                <h2 class="text-center mt-2 text-white">Tổng đơn hàng thành công</h2>
                <h1 class="text-center mt-5 text-white">{{ isset($totalOrderSucsess->total) ? ($totalOrderSucsess->total) : '0' }}
            </div>
        </div>
    </div>

@endsection
