@extends('front.layout.master')
@section('title',$category->name)
@section('header_title', $category->name)
@section('header_description', '')
@section('content')

    <div class="col-md-9 mx-auto">
     @include('front.widgets.articleList')
    </div>
    @include('front.widgets.categoryWidget')
    </div>



@endsection
