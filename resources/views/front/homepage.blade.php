@extends('front.layout.master')
@section('title', 'Homepage')
@section('header_title', 'The North Remembers!')
@section('header_description', 'When the snows fall and the white winds blow, the lone wolf dies but the pack survives')
@section('content')

    <div class="col-md-9 mx-auto article custom-scrollbar-css custom-scrollbar-js p-2" id="content-5"
         style="background-image:url('{{ASSET('front/')}}/img/The_North.png');">
        @include('front.widgets.articleList')
    </div>
    @include('front.widgets.categoryWidget')
    </div>

    <hr>
    <div id="wrapper" style="margin-top:40px;">
        <div id="main-house">
            <div class="house-1">
                @foreach($categories as $category)
                    <div class="item"><img src="{{$category->image}}">{{$category->name}}</div>
                @endforeach
            </div>
        </div>
        <div id="temizle" style="height:40px;"></div>

        <div style="text-align:center;"><h1>The North Map</h1></div>
        <div id="main-map"><img src="{{ASSET('front/')}}/img/The_North2.png"></div>
    </div>

@endsection
