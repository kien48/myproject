@extends("layout.main")
@section("content")
    <div class="container mt-4">
        <h1 class="h3 text-center mb-4">Trang danh sách các sản phẩm trong đơn hàng</h1>
        @if(isset($_SESSION['errors']) && isset($_GET['msg']))
            <div class="alert alert-danger" role="alert">
                <span>{{$_SESSION['errors']}}</span>
            </div>
        @endif

        @if(isset($_SESSION['success']) && isset($_GET['msg']))
            <div class="alert alert-success" role="alert">
                <span>{{$_SESSION['success']}}</span>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped" id="myTable">

                <thead class="thead-light">
                <tr>
                    <th>STT</th>
                    <th>Mã hóa đơn</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng tiền</th>
                    <th>Cỡ</th>
                    <th>Màu</th>
                </tr>
                </thead>
                <tbody>
                <form action="{{route('huy')}}" method="post">
                    @php $key = 1 @endphp
                    @foreach($order as $item)
                        <tr class="table">
                            <td>{{$key++}}</td>
                            <td>{{$item->id}}</td>
                            <td>{{$item->product_name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{number_format($item->price)}}đ</td>
                            <td>{{number_format($item->total)}}đ</td>
                            <td>{{$item->size}}</td>
                            <td>{{$item->color}}</td>
                        </tr>
                @endforeach
                </tbody>

                <tr>
                    <th>Người mua</th>
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày mua</th>
                    <th>Ghi chú</th>
                    <th>Tổng tiền</th>
                </tr>
                <tr>
                    <td>{{$item->customer_name}}</td>
                    <td>{{$item->customer_phone}}</td>
                    <td>{{$item->customer_address}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->note}}</td>
                    <td>{{number_format($item->total_amount)}}đ</td>
                </tr>
            </table>
        </div>

            </form>
            <div class="text-center mt-3">
                <a href="{{route('admin/orde/1')}}" class="btn btn-secondary">Danh sách</a>
                <a href="{{route('admin/order/detail/update/'.$item->id)}}" class="btn btn-warning">Cập nhật trạng thái</a>
                <a href="" class="btn btn-info">In đơn hàng</a>
            </div>
    </div>


    <button onclick="exportToExcel()">Export to Excel</button>

    <script>
        function exportToExcel() {
            let htmltable = document.getElementById('myTable');
            let html = htmltable.outerHTML;
            let url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
            let downloadLink = document.createElement("a");
            downloadLink.href = url;
            downloadLink.download = "table.xls";
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
    </script>
@endsection


