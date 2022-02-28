@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Articles')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.articles.index') }}">{{__('Articles')}}</a></li>
        <li class="breadcrumb-item">{{__('Create')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{--Title--}}
                    <div class="form-group">
                        <label>{{__('Title')}}<span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                               required autofocus>
                    </div>


                    {{--Description--}}
                    <div class="form-group">
                        <label>{{__('Description')}}<span class="text-danger">*</span></label>
                        {{ Form::textarea('description', null, ['placeholder' => 'Description', 'class' => 'form-control',
                           'autofocus'=>'autofocus' , 'required' =>'required']) }}
                    </div>

                    {{--Category--}}
                    <div class="form-group">
                        <label class="form-label">{{__("Category")}} <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-control select2" required>
                            <option value="">{{__('Choose category')}}</option>
                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{--Image--}}
                    <div class="form-group">
                        <label class="form-label">{{__('Image of article')}}</label>
                        <input type="file" name="image" class="form-control load-image">
                        <img  class="loaded-image" alt="" style="display: block; width: 200px; margin: 10px 0;">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>{{__('Create')}}
                        </button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


