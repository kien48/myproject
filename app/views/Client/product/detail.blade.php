@extends("layout.main")
@section("content")

    <div class="row">
        <div class="d-flex justify-content-between mb-3">
            <h1 class="h5 text-black-50">{{$product->name_ct}} / {{$product->name}}</h1>
        </div>
        <div class="col-md-4">
            <div class="bg-light d-flex align-items-center" style="height: 560px;">
                <img src="../{{$product->image}}" alt="" class="mh-100 mw-100">
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-light d-flex align-items-center" style="height: 560px;">
                <img src="../{{$product->image2}}" alt="" class="mh-100 mw-100">
            </div>
        </div>

        <div class="table-responsive col-md-4">
            <div class="">
                <h1 class="h3">{{$product->name}}</h1>
                <div class="d-flex align-items-center">
                    <h1 class="h5">Đã bán
                        @if(empty($total->total_sold))
                            0
                         @else
                            {{$total->total_sold}}
                        @endif
                        | @if($rating->average_rating !=0)
                            <span class="">
                                @for($i =0;$rating->average_rating > $i; $i++)
                                    <i class="fa-solid fa-star text-warning"></i> </span>
                                @endfor
                            <h5 class="ms-1"> | {{$rating->number}} lượt đánh giá </h5>
                        @else
                            <span>Chưa có đánh giá sản phẩm</span>

                        @endif

                    </h1>
                </div>
                <div class="d-flex align-items-center">
                    <!-- Giá bán -->
                    <div class="fw-bold text-danger h3">{{number_format($product->price)}}đ</div>
                </div>


            @if(count($bienThe)>=1)
                    <form action="{{route('add-cart')}}" method="post">
                    <div>
                        <h1 class="h4">Kích cỡ:</h1>
                        <div class="d-flex">
                            @php
                                $uniqueSizes = [];
                            @endphp

                            @foreach($bienThe as $size)
                                @if(!in_array($size->size, $uniqueSizes))
                                    <div class="form-check ms-4">
                                        <input type="radio" class="form-check-input size_radio" id="size_radio_{{$loop->index}}" name="size_radio[]"
                                               value="{{$size->size}}" >
                                        <label class="form-check-label" for="size_radio_{{$loop->index}}">{{$size->size}}</label>
                                    </div>
                                    @php
                                        $uniqueSizes[] = $size->size;
                                    @endphp
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h1 class="h4">Màu sắc:</h1>
                        <div class="d-flex" id="color_options">
                            <!-- Màu sắc sẽ được thêm vào đây -->
                        </div>
                    </div>

                    <script>
                        // Lắng nghe sự kiện khi click vào kích cỡ
                        document.querySelectorAll('.size_radio').forEach(function(radio) {
                            radio.addEventListener('click', function() {
                                var selectedSize = this.value;
                                var colorsHtml = '';

                                // Tìm các màu sắc và số lượng tương ứng với kích cỡ được chọn
                                @foreach($bienThe as $color)
                                        @php
                                            $class = "";
                                            $sl = "";
                                            if($color->quantity == 0){
                                                $sl = "0";
                                                $class = "disabled";
                                            } else {
                                                $sl = $color->quantity;
                                            }
                                            if($color->color == "Hồng"){
                                                $style = "pink";
                                            }elseif($color->color == "Đen"){
                                                 $style = "black";
                                            }elseif($color->color == "Đỏ"){
                                                 $style = "red";
                                            }elseif($color->color == "Trắng"){
                                                 $style = "black";
                                            }elseif($color->color == "Vàng"){
                                                 $style = "yellow";
                                            }elseif($color->color == "Xanh"){
                                                 $style = "green";
                                            }
                                        @endphp
                                if ("{{$color->size}}" === selectedSize) {
                                    colorsHtml += '<div class="form-check ms-4">' +
                                        '<input type="radio" class="form-check-input"  {{$class}} id="color_radio{{$color->id}}" name="color_radio[]" value="{{$color->color}}" >' +
                                        '<label class="form-check-label " for="color_radio{{$color->id}}" ><h5 style="color:{{$style}}">{{$color->color}}</h5> - Kho còn: {{$sl}}</label> sản phẩm' +
                                        '</div>';
                                }
                                @endforeach

                                // Thêm HTML màu sắc vào phần tử có id là 'color_options'
                                document.getElementById('color_options').innerHTML = colorsHtml;
                            });
                        });
                    </script>


                    <div>

                            <h1 class="h4">Số lượng:</h1>
                            <div class="d-flex">
                                <div class="input-group">
                                    <button onclick="minus(this)" type="button" class="btn btn-outline-secondary btn-sm">-</button>
                                    <input onkeyup="kiemtrasoluong(this)" value="{{$soLuong}}" type="text" class="form-control form-control-sm" name="quantity" min="1"  style="max-width: 35px">
                                    <button onclick="plus(this)" type="button" class="btn btn-outline-secondary btn-sm">+</button>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <input type="hidden" name="name" value="{{$product->name}}">
                            <input type="hidden" name="price" value="{{$product->price}}">
                            <input type="hidden" name="image" value="{{$product->image}}">
                            <input type="hidden" name="category" value="{{$product->name_ct}}">
                            <button type="button" class="btn btn-warning w-100 col-12 mt-3" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ
                                hàng
                            </button>
                            <!-- The Modal -->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Bạn có chắc chắn muốn thêm vào giỏ hàng không ?</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="them" class="btn btn-warning" data-bs-dismiss="modal">Thêm</button>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            </form>
                        </div>
                    </div>
        <div class="mt-3">
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

        </div>

            @else
                Sản phẩm đang cập nhật số lượng và màu sắc bạn vui lòng chờ
                @endif
            </div>
        </div>

        <div class="col-md-8">
            <hr>
            <h1 class="h3">Đặc tính nổi bật</h1>

                @php
                    $text = htmlspecialchars($product->description);
                    $text = html_entity_decode($text);
                    echo $text;
                @endphp
            <div id="accordion">

                <div class="card mt-2">
                    <div class="card-header">
                        <a class="collapsed btn w-100" data-bs-toggle="collapse" href="#collapseTwo">
                            Hướng dẫn sử dụng
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body">
                            <h1 class="h5">
                                <ul>
                                    <li>Giặt máy chế độ nhẹ với sản phẩm cùng màu ở nhiệt độ thường.</li>
                                    <li>Không giặt chung với các vật sắc nhọn.</li>
                                    <li>Không sử dụng chất tẩy rửa.</li>
                                    <li>Sử dụng xà phòng trung tính</li>
                                    <li>Lộn trái và phơi bằng móc trong bóng râm, tránh ánh nắng trực tiếp</li>
                                    <li>Là ủi ở mức 1, Nhiệt độ dưới 110 độ C</li>
                                </ul>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header">
                        <a class="collapsed btn w-100" data-bs-toggle="collapse" href="#collapseThree">
                            Đánh giá
                        </a>
                    </div>
                    <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body">
                            <form class=" mb-3" method="post" action="{{route('add-comment/'.$product->id)}}">
                                <textarea name="content" id="" cols="30" rows="5" class="form-control me-2" placeholder="Nhập bình luận @if(isset($_SESSION['user']))đi nào {{$_SESSION['user']->username}} @else với tư cách người ẩn danh
                                @endif
                                "></textarea>

                                @if(isset($_SESSION['user']))
                                    <div class="ms-auto">
                                        <div class="rating-star d-flex justify-content-center">
                                            <div class="ms-4">
                                                <input type="radio" name="option[]" id="option1" value="5">
                                                <label for="option1">5 sao</label>
                                            </div>
                                            <div class="ms-4">
                                                <input type="radio" name="option[]" id="option2" value="4">
                                                <label for="option2">4 sao</label>
                                            </div>

                                            <div class="ms-4">
                                                <input type="radio" name="option[]" id="option3" value="3">
                                                <label for="option3">3 sao</label>
                                            </div>

                                            <div class="ms-4">
                                                <input type="radio" name="option[]" id="option4" value="2">
                                                <label for="option4">2 sao</label>
                                            </div>

                                            <div class="ms-4">
                                                <input type="radio" name="option[]" id="option5" value="1">
                                                <label for="option5">1 sao</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <button class="btn btn-primary" type="submit" name="send">Gửi</button>
                            </form>


                            @foreach ($listComment as $list)
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="card-title">
                                                @if ($list->username)
                                                    {{$list->username}}
                                                @else
                                                    Người ẩn danh
                                                @endif
                                            </h5>
                                            <h4 class="text-warning">
                                                @if ($list->star != 0)
                                                    {{$list->star}} <i class="fa-solid fa-star"></i>
                                                @endif
                                            </h4>
                                        </div>
                                        <p class="card-text">{{$list->content}}</p>
                                    </div>
                                </div>


                                @if (isset($feedback))
                                    @foreach ($feedback as $key=>$value)
                                        @if(count($value)>=1)
                                            @if ($value[0]->id_comment == $list->id)

                                                <div class="text-end "><i class="fa-solid fa-turn-down"></i></div>
                                                <div class="d-flex justify-content-end mb-4">
                                                    <div class="card bg-warning" style="width: 400px">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="card-title">
                                                                    admin
                                                                </h5>
                                                            </div>
                                                            <p class="card-text">{{$value[0]->text}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach


                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="row">
        <div class="d-flex justify-content-between mt-4">
            <h1 class="h4 text-black-50">Sản phẩm liên quan</h1>
        </div>
        @foreach($productCL as $pro)
            <div class="col-md-3">
                <!-- box hiển thị sản phẩm -->
                <a href="{{route('detail/'.$pro->id)}}" class="nav-link">
                    <div class="border mt-3 mb-3 rounded overflow-hidden  bg-light">
                        <!-- Khu vực ảnh -->
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 406px;">
                            <img src="../{{$pro->image}}" alt="" class="mh-100 mw-100">
                        </div>
                        <div class="m-2">
                            <!-- Kv tên sản phẩm -->
                            <h1 class="h5" style="height: 68px; ">{{$pro->name}}</h1>
                </a>
                            <div class="d-flex justify-content-center">
                                <!-- Giá bán -->
                                <div class="fw-bolder text-danger">{{number_format($pro->price)}} vnđ</div>
                            </div>
                        </div>

            <div class="container text-center mt-2">
                <div class="row">

                    @foreach($bienThe1 as $item)
                        @if($item->idpro == $pro->id)
                            @php
                                $style = ''; // Khởi tạo biến màu
                                if($item->color == "Hồng"){
                                    $style = "pink";
                                } elseif($item->color == "Đen"){
                                    $style = "black";
                                } elseif($item->color == "Đỏ"){
                                    $style = "red";
                                } elseif($item->color == "Trắng"){
                                    $style = "white";
                                } elseif($item->color == "Vàng"){
                                    $style = "yellow";
                                } elseif($item->color == "Xanh"){
                                    $style = "green";
                                }
                            @endphp
                            <div class="col-2">
                                <div class="h3" style="color: {{$style}}"  data-bs-toggle="tooltip" title="{{$item->color}}"><i class="fa-solid fa-circle"></i></div>
                            </div>
                        @endif
                    @endforeach


                </div>
            </div>
                    </div>

            </div>
        @endforeach

    </div>


@endsection