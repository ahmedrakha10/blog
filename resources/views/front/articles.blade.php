@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="section">
            <div class="jumbotron">
                <h1 class="display-6 text-center">{{__('Articles')}}</h1>
            </div>
        </div>

        <section>

            <div class="col-md-6" style="margin: auto">
                <form action="{{route('front.index')}}" method="get" class="search_form">
                    <div class="form-group mb-5">
                        <input type="text" name="query" value="{{request('query')}}" id="data-table-search"
                               class="form-control" autofocus
                               placeholder="{{__('Search in articles')}}">
                    </div>
                </form>
            </div>
            <div class="row">
                @if($articles->count() > 0)
                    @foreach($articles as $article)
                        <div class="col-md-4">
                            <div class="card" style="margin-bottom: 10px">
                                <img src="{{Storage::url('uploads/articles/'.$article->image)}}"
                                     style="width: 100%; height: 150px;" class="card-img-top">
                                <div class="card-body">
                                    <a href="{{route('front.article_details',$article->id)}}"><h5
                                            class="card-title">{{$article->title}}</h5></a>
                                    <span></span>
                                    <p class="card-text">{{$article->description}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">No results found , try again</p>
                @endif
            </div>
            <div class="d-flex justify-content-center" style="margin-bottom: 40px">{!! $articles->links() !!}</div>
        </section>
    </div>
@endsection
