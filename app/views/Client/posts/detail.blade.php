@extends("layout.main")
@section("content")

<div class="container mt-3 mb-5">
    <!-- Page Heading -->
    <div>
        @php
        $text = htmlspecialchars($listOne->text);
        $text = html_entity_decode($text);
        echo $text;
        @endphp
    </div>
    <hr>
    <br>

    <div class="d-flex justify-content-between">
        <div>ngày đăng : {{$listOne->date}}</div>
        <div>Người viết : {{$listOne->author}}</div>
    </div>
    <br>



    @endsection