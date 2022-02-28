@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Categories')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">{{__('Categories')}}</a></li>
        <li class="breadcrumb-item">{{__('Create')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.categories.store') }}">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <label>{{__('Name')}}<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required
                               autofocus>
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


