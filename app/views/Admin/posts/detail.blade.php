@extends("layout.main")
@section('content')
    <div class="container mt-3">
        <!-- Page Heading -->
        <h3 class="text-center mb-3">Trang chi tiết bài viết</h3>

   <div style="height: 500px; overflow-y: auto;">
       @php
           $text = htmlspecialchars($listOne->text);
           $text = html_entity_decode($text);
           echo $text;
       @endphp
   </div>
        <hr>
        <br>
        <div class="text-center">ngày đăng : {{$listOne->date}}</div> <br>



@endsection
