@extends('back.layouts.master')
@section('title','Deleted Articles')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
                <span class="float-right"><strong>{{$articles->count()}}</strong> Article Found
                <a href="{{route('admin.articles.index')}}" class="btn btn-primary btn-sm">Active Articles</a>
            </span>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Article Title</th>
                        <th>Category</th>
                        <th>Views</th>
                        <th>C. Date</th>
                        <th>Transactions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>
                                <img src="{{$article->image}}" width="150">
                            </td>
                            <td>{{$article->title}}</td>
                            <td>{{$article->getCategory->name}}</td>
                            <td>{{$article->hit}}</td>
                            <td>{{$article->created_at->diffForHumans()}}</td>
                            <td>
                            <a href="{{route('admin.recover.article',$article->id)}}" title="Restore"
                               class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                            <a href="{{route('admin.hard.delete.article',$article->id)}}" title="Delete"
                               class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
