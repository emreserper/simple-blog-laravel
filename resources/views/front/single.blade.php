@extends('front.layout.master')
@section('title', $article->title)
@section('header_title', $article->title)
@section('header_description', $article->getCategory->name)
@section('bg',$article->image)
@section('content')



                <div class="col-md-9 mx-auto">
                    <h2 class="post-title">
                        {{$article->title}}
                    </h2>
                    {!!$article->content!!}
                    <br> <hr>
<span class="text-danger" >Views : <b>{{$article->hit}}</b></span>
                    <hr>
                </div>
                @include('front.widgets.categoryWidget')
@endsection
