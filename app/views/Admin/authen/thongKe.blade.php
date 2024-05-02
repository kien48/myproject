@extends('layout.main')
@section("content")
    <head>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawStuff);

            function drawStuff() {
                var data = new google.visualization.arrayToDataTable([
                    ['Bình luận', 'bình luận'],
                        @foreach($thongKeBL as $key=>$value)
                    ['{{$value->username}}', {{$value->total_comments}}],
                    @endforeach
                ]);

                var options = {
                    width: 800,
                    legend: { position: 'none' },
                    chart: {
                        title: 'Thống kê người dùng bình luận',
                        subtitle: 'popularity by percentage' },

                    bar: { groupWidth: "60%" }
                };

                var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                // Convert the Classic options to Material options.
                chart.draw(data, google.charts.Bar.convertOptions(options));
            };



            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Tài khoản', 'Đã đặt', 'Tổng tiền', 'Đặt thành công'],
                    // ['2014', 1000, 400, 200],
                    // ['2015', 1170, 460, 250],
                    // ['2016', 660, 1120, 300],
                    // ['2017', 1030, 540, 350]

                            @foreach($thongKeMuaHang as $key=>$value)
                    ['{{$value->username}}', {{$value->total_orders}},'{{number_format($value->total_amount_status_3)}}đ'
                        , {{$value->total_orders_status_3  }}],
                    @endforeach
                ]);

                var options = {
                    chart: {
                        title: 'Thống kê tài khoản đặt hàng',
                        subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }


        </script>
    </head>
    <body>
    <div class="d-flex">
        <div id="top_x_div" class="w-50" style="height: 500px;"></div>
        <div id="columnchart_material" class="w-50" style="height: 500px; "></div>
    </div>

    </body>

@endsection
