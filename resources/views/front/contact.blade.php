@extends('front.layout.master')
@section('title', 'Contact')
@section('header_title', 'Contact')
@section('bg','https://i.redd.it/96c0zbg20bfy.jpg')
@section('content')



    <div class="col-md-8">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="{{route('contact.post')}}">
            @csrf
            <div class="control-group">
                <div class="form-group controls">
                    <label>Name Surname</label>
                    <input type="text" class="form-control" value="{{old('name')}}" placeholder="Name" name="name"
                           required>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group  controls">
                    <label>Email Address</label>
                    <input type="email" class="form-control" value="{{old('email')}}" placeholder="Email Address"
                           name="email" required>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group col-xs-12  controls">
                    <label>Topic</label>
                    <select class="form-control" name="topic">
                        <option @if(old('topic')=="Information") selected @endif>Information</option>
                        <option @if(old('topic')=="Support") selected @endif>Support</option>
                        <option @if(old('topic')=="General") selected @endif>General</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group  controls">
                    <label>Message</label>
                    <textarea rows="5" class="form-control" name="message" placeholder="Message"
                              required>{{old('message')}}</textarea>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <div class="card card-default">
            <div class="card-body">Panel Content</div>
            adress: bla bla bla
        </div>
    </div>
@endsection
