@extends('back.layouts.master')
@section('title','All Categories')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create a Category</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.category.create')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" name="category" required/>
                        </div>
                        <div class="form-group">
                            <label>Category Photo</label>
                            <input type="file" name="image" class="form-control" required></input>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Add Category</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Category Title</th>
                            <th>Article Count</th>
                            <th>Status</th>
                            <th>Transactions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <img src="{{$category->image}}" width="100">
                                </td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->articleCount()}}</td>
                                <td><input class="switch" category-id="{{$category->id}}" type="checkbox"
                                           data-on="Active"
                                           data-off="Pasif" data-onstyle="success" data-offstyle="danger"
                                           @if($category->status==1) checked @endif data-toggle="toggle">
                                </td>
                                <td>
                                    <a category-id="{{$category->id}}" class="btn btn-sm btn-primary edit-click"
                                       title="Edit Category"><i
                                            class="fa fa-edit text-white"></i></a>
                                    <a category-id="{{$category->id}}" category-count="{{$category->articleCount()}}"
                                       class="btn btn-sm btn-danger remove-click"
                                       title="Delete Category"><i
                                            class="fa fa-times text-white"></i></a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.category.update')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <input id="category" type="text" class="form-control" name="category">
                            <input type="hidden" name="id" id="category_id">
                        </div>
                        <div class="form-group">
                            <label>Category Photo</label> <br>
                            <img id="image" src="{{asset($category->image)}}" class=" img-thumbnail rounded"
                                 style="margin-bottom:10px;" width="300">
                            <input id="" type="file" name="image" class="form-control">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>

            </div>

        </div>
    </div>
    <!-- Modal -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="articleAlert"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <form method="post" action="{{route('admin.category.delete')}}">
                        @csrf
                        <input type="hidden" name="id" id="deleteId">
                        <button id="deleteButton" type="submit"
                                class="btn btn-success">Delete
                        </button>
                    </form>
                </div>


            </div>

        </div>
    </div>
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function () {
            $('.remove-click').click(function () {
                id = $(this)[0].getAttribute('category-id');
                count = $(this)[0].getAttribute('category-count');

                if (id == 1) {
                    $('#articleAlert').html('The General category is the fixed category. Articles from other deleted categories will be added here.');
                    $('#deleteButton').hide();
                    $('#deleteModal').modal();
                    return;
                }
                $('#deleteButton').show();
                $('#deleteId').val(id);
                if (count > 0) {
                    $('#articleAlert').html('There are ' + count + ' articles in this category. Are you sure you want to delete?');
                } else {
                    $('#articleAlert').html('There are no articles in this category. Are you sure you want to delete?');
                }
                $('#deleteModal').modal();
            });

            $('.edit-click').click(function () {
                id = $(this)[0].getAttribute('category-id');
                $.ajax({
                    type: 'GET',
                    url: '{{route('admin.category.getdata')}}',
                    data: {id: id},
                    success: function (data) {
                        console.log(data);
                        $('#category').val(data.name);
                        $('#image').attr('src', data.image);
                        $('#category_id').val(data.id);
                        $('#editModal').modal();
                    }
                });
            });

            $('.switch').change(function () {
                id = $(this)[0].getAttribute('category-id');
                statu = $(this).prop('checked');

                $.get("{{route('admin.category.switch')}}", {id: id, statu: statu}, function (data, status) {
                });
            })
        })
    </script>
@endsection

