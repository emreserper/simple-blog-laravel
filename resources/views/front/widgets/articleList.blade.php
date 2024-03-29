@if(count($articles)>0)
    @foreach($articles as $article)
        <div class="post-preview">
            <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
                <img src="{{$article->image}}">
                <h2 class="post-title">
                    {{$article->title}}
                </h2>

                <h3 class="post-subtitle">
                    {!!Str::limit($article->content,100)!!}
                </h3>
            </a>
            <p class="post-meta"> Households:
                <a href="#">{{$article->getCategory->name}}</a>
                <span class="float-right"> {{$article->created_at->diffForHumans()}}</span>
            </p>
        </div>
        @if(!$loop->last)
            <hr>
        @endif
    @endforeach
    <div>
        {{$articles->links()}}
    </div>
@else
    <div class="alert alert-danger">
        <h1>No articles for this category were found</h1>
    </div>
@endif
