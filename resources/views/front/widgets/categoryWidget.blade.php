@isset($categories)
<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            <img src="{{ASSET('front/')}}/img/stark_icon.png" style="width:25%"> Households
        </div>
        <div class="list-group">
            @foreach($categories as $category)
                <li class="list-group-item @if(Request::segment(2)==$category->slug) active @endif" style="@if(Request::segment(2)==$category->slug) background-color:gray; border-color:black;@endif">
                <a @if(Request::segment(2)!=$category->slug) href="{{route('category',$category->slug)}}" @endif>{{$category->name}}<span class="badge float-right">{{$category->articleCount()}}</span></a>
                </li>
            @endforeach
        </div>
    </div>
</div>
@endif

