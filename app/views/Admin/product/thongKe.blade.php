@extends('layout.main')
@section("content")
    <div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart', 'bar']});
            google.charts.setOnLoadCallback(drawCharts);

            function drawCharts() {
                drawPieChart();
                drawColumnChart();
                drawBasic();
            }

            function drawPieChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Danh mục', 'Số lượng sản phẩm'],
                        @foreach($thongKe as $key=>$value)
                    ['{{$value->ten_danh_muc}}', {{$value->so_luong_san_pham}}],
                    @endforeach
                ]);

                var options = {
                    title: 'Thống kê sản phẩm trong danh mục'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            }

            function drawColumnChart() {
                var data = google.visualization.arrayToDataTable([
                    ["Sản phẩm", "Số Sao"],
                        @foreach($sao as $key=>$value)
                    ['{{$value->ten_san_pham}}', {{$value->star}}],
                    @endforeach
                ]);

                var options = {
                    title: "Đánh giá sản phẩm",
                    width: 600,
                    height: 400,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                };

                var chart = new google.visualization.BarChart(document.getElementById("chart_div"));
                chart.draw(data, options);
            }

            function drawBasic() {
                var data = google.visualization.arrayToDataTable([
                    ['Sản phẩm', 'Số Sao'],
                        @foreach($sao as $key=>$value)
                    ['{{$value->ten_san_pham}}', {{$value->star}}],
                    @endforeach
                ]);

                var options = {
                    title: 'Đánh giá sản phẩm',
                    chartArea: {width: '100%'},
                    hAxis: {
                        title: 'Tổng số sao',
                        minValue: 0
                    },
                    vAxis: {
                        title: 'Sản phẩm'
                    }
                };

                var chart = new google.visualization.BarChart(document.getElementById('barchart_values'));
                chart.draw(data, options);
            }
        </script>
    </div>

    <div class="d-flex">
        <div id="piechart" style="width: 400px; height: 500px;"></div>
        <div id="chart_div"  style="width: 800px; "></div>
    </div>

    <table class="table">
        <thead>
        <th>Sản phẩm giá thấp nhất</th>
        <th>Trung bình giá</th>
        <th>Sản phẩm giá cao nhất</th>
        </thead>
        <tbody>
        <tr>
            <td>{{number_format($gia->gia_thap_nhat)}}đ</td>
            <td>{{number_format($gia->gia_trung_binh)}}đ</td>
            <td>{{number_format($gia->gia_cao_nhat)}}đ</td>
        </tr>
        </tbody>
    </table>
@endsection
