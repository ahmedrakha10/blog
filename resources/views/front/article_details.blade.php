@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="section">
            <div class="jumbotron">
                <h1 class="display-6 text-center"><a style="color: inherit" href="{{route('front.index')}}">{{__('Articles')}}</a>  / {{$article->title}}</h1>
            </div>
        </div>
        <div class="article">
            <div class="container">
                <div class="article_details_card">
                    <div class="det__thumb">
                        <img src="{{Storage::url('uploads/articles/'.$article->image)}}" alt="" class="img-fluid">
                    </div>
                    <div class="det_body">
                        <h3 class="det_title">{{$article->title}}</h3>
                        <p class="det__des">{{$article->description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
