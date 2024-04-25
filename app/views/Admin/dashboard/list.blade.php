@extends('layout.main')
@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Chào mừng bạn đến với trang admin</h3>
    </div>
    <div class="container">
        <div class="row mt-3 d-flex  justify-content-center">
            <div class="col-md-3 mt-3 border bg-warning" style="height: 200px">
                <h2 class="text-center mt-2">Tổng tiền hôm nay </h2>
                <h1 class="text-center mt-5">{{ isset($totalToday[0]->total_today) ? number_format($totalToday[0]->total_today) : '0' }}
                    <i class="fa-solid fa-dong-sign"></i></h1>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3 mt-3 border bg-warning" style="height: 200px">
                <h2 class="text-center mt-2">Tổng tiền tuần này </h2>
                <h1 class="text-center mt-5">{{ isset($totalToday[0]->total_week) ? number_format($totalToday[0]->total_week) : '0' }}
                    <i class="fa-solid fa-dong-sign"></i></h1>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3 mt-3 border bg-warning" style="height: 200px">
                <h2 class="text-center mt-2">Tổng tiền tháng </h2>
                <h1 class="text-center mt-5">{{ isset($totalToday[0]->total_month) ? number_format($totalToday[0]->total_month) : '0' }}
                    <i class="fa-solid fa-dong-sign"></i></h1>
            </div>

            <div class="col-md-3 mt-3 border bg-success" style="height: 200px">
                <h2 class="text-center mt-2 text-white">Tổng doanh thu hôm nay </h2>
                <h1 class="text-center mt-5 text-white">{{ isset($totalToday[0]->total_revenue_today) ? number_format($totalToday[0]->total_revenue_today) : '0' }}
                    <i class="fa-solid fa-dong-sign"></i></h1>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3 mt-3 border bg-success" style="height: 200px">
                <h2 class="text-center mt-2 text-white">Tổng doanh thu tuần này </h2>
                <h1 class="text-center mt-5 text-white">{{ isset($totalToday[0]->total_revenue_week) ? number_format($totalToday[0]->total_revenue_week) : '0' }}
                    <i class="fa-solid fa-dong-sign"></i></h1>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3 mt-3 border bg-success" style="height: 200px">
                <h2 class="text-center mt-2 text-white">Tổng doanh thu tháng </h2>
                <h1 class="text-center mt-5 text-white">{{ isset($totalToday[0]->total_revenue_month) ? number_format($totalToday[0]->total_revenue_month) : '0' }}
                    <i class="fa-solid fa-dong-sign"></i></h1>
            </div>
        </div>
    </div>
@endsection
