@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Home')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">{{__('Statistics')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">


            <div class="row">

                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-users"></span> {{__('Users')}}</p>
                                <a href="{{route('admin.users.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <h3 class="mb-0">{{$users}}</h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-list"></span> {{__('Categories')}}</p>
                                <a href="{{route('admin.categories.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0">{{$categories}}</h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-newspaper-o"></span> {{__('Articles')}}</p>
                                <a href="{{route('admin.articles.index')}}">{{__('Show all ...')}}</a>
                            </div>

                            <h3 class="mb-0">{{$articles}}</h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

            </div>   <!-- end of row-->


        </div><!-- End of col -->

    </div><!-- End of row -->
@endsection
