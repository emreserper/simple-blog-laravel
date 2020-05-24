<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title') - {{$config->title}}</title>
    <link href="{{asset('front/')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('front/')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link
        href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
        rel='stylesheet' type='text/css'>
    <link href="{{asset('front/')}}/css/clean-blog.min.css" rel="stylesheet">
    <link
        href='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css'
        rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" type="image/png" href="{{asset($config->favicon)}}"/>
</head>
<style>
    #temizle {
        clear: both;
    }

    #wrapper {
        position: relative;
        width: 100%;
        margin: 0 auto;
    }

    .house-1 {

        width: 100%;
        text-align: center;
        display: block;
    }

    .house-1 > .item {
        float: left;
        width: 25%;
        padding: 2%;
        border-bottom: 1px solid lightgray;
        transition: all 0.2s ease-in;
    }

    .house-1 > .item:hover {
        color: #0085a1;
        transition: all .2s;
    }

    .house-1 > .item > img {
        width: 100%;
        transition: all 0.2s ease-in;
        margin-bottom: 20px;
    }

    .house-1 > .item > img:hover {
        transition: all 0.2s ease-in;
        -webkit-transform: scale(1.05);
        transform: scale(1.05);
        opacity: 0.8;
    }


    #main-house {
        width: 100%;
        position: relative;
        text-align: center;
    }

    .article {
        height: 800px;
        margin-bottom: 10px;
        overflow-y: scroll;
        -webkit-overflow-scrolling: touch;

    }

    @media only screen and (max-width: 1000px) {
        .article {
            margin-top: 50px;
        }

        .house-1 > .item {
            width: 33%;

        }
    }

    @media only screen and (max-width: 700px) {
        .house-1 > .item {
            width: 50%;
            padding: 1%;
        }
    }

    /* Custom Scrollbar using CSS */
    .custom-scrollbar-css {
        overflow-y: scroll;
    }

    /* scrollbar width */
    .custom-scrollbar-css::-webkit-scrollbar {
        width: 5px;
    }

    /* scrollbar track */
    .custom-scrollbar-css::-webkit-scrollbar-track {
        background: #eee;
    }

    /* scrollbar handle */
    .custom-scrollbar-css::-webkit-scrollbar-thumb {
        border-radius: 1rem;
        background-color: gray;

    }

    #main-map > img {
        width: 100%;
    }

</style>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{route('homepage')}}">
            @if($config->logo!=null)
                <img src="{{ASSET($config->logo)}}" width="200">
            @else
                {{$config->title}}
            @endif
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('homepage')}}">Home</a>
                </li>
                @foreach($pages as $page)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('page',$page->slug)}}">{{$page->title}}</a>
                    </li>
                @endforeach
                <li class="nav-item">
                    <a class="nav-link" href="{{route('contact')}}">Contact</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- Page Header -->

<header class="masthead" style="background-image: url('@yield('bg',ASSET('front/img/banner1.jpg'))')">

    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h2>@yield('header_title')</h2>
                    <span class="subheading">@yield('header_description')</span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
