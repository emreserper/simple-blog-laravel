@extends('back.layouts.master')
@section('title',$page->title.' Page Update')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-8 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{route('admin.page.edit.post',$page->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Article Title</label>
                    <input type="text" name="title" class="form-control" value="{{$page->title}}" required></input>
                </div>
                <div class="form-group">
                    <label>Article Photo</label> <br>
                    <img src="{{asset($page->image)}}" class=" img-thumbnail rounded" style="margin-bottom:10px;" width="300">
                    <input type="file" name="image" class="form-control"></input>
                </div>
                <div class="form-group">
                    <label>Article Content</label>
                    <textarea id="editor" name="content" class="form-control"
                              rows="5">{!! $page->content !!}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Update Article</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('css')
    <!-- include summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
    <!-- include summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#editor').summernote(
                {'height': 300}
            );
        });
    </script>
@endsection
