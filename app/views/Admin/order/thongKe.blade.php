@extends('layout.main')

@section("content")
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Số lượng'],
                    @foreach($thongKe as $value)
                    @php
                        $status = '';
                        switch ($value->status) {
                            case 1:
                                $status = 'Đang chuẩn bị hàng';
                                break;
                            case 2:
                                $status = 'Đang giao';
                                break;
                            case 3:
                                $status = 'Đã nhận';
                                break;
                            case 4:
                                $status = 'Đã hủy';
                                break;
                                }
                    @endphp
                ['{{ $status }}', {{ $value->total_orders }}],
                @endforeach
            ]);

            var options = {
                title: 'Thống kê đơn hàng',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
<div id="piechart_3d" style="width:100%; height: 500px;"></div>
<table class="table">
    <thead>
    <th>Đơn thấp nhất</th>
    <th>Đơn trung bình</th>
    <th>Đơn cao nhất</th>
    </thead>
    <tbody>
    <tr>
        <td>{{number_format($gia->don_cao_nhat)}}đ</td>
        <td>{{number_format($gia->don_trung_binh)}}đ</td>
        <td>{{number_format($gia->don_thap_nhat)}}đ</td>
    </tr>
    </tbody>
</table>
</body>
@endsection
