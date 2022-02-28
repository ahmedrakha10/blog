@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Articles')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item">{{__('Articles')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i>
                            {{__('Create article')}}</a>

                        <form method="post" action="{{ route('admin.articles.bulk_delete') }}"
                              style="display: inline-block;">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="record_ids" id="record-ids">
                            <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i
                                    class="fa fa-trash"></i>
                                {{__('Bulk delete')}}</button>
                        </form>


                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus
                                   placeholder="{{__('Search')}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                <select id="category" class="form-control select2">
                                    <option value="">{{__('All categories')}}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="articles-table" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="animated-checkbox">
                                            <label class="m-0">
                                                <input type="checkbox" id="record__select-all">
                                                <span class="label-text"></span>
                                            </label>
                                        </div>
                                    </th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Description')}}</th>
                                    <th>{{__('Category')}}</th>
                                    <th>{{__('Views')}}</th>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('Created at')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                                </thead>
                            </table>

                        </div><!-- end of table responsive -->

                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

@push('scripts')

    <script>

        let category;
        let articlesTable = $('#articles-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.articles.data') }}',
                data: function (d) {
                    d.category_id = category;
                }
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description'},
                {data: 'category', name: 'category', searchable: false, sortable: false,},
                {data: 'views', name: 'views'},
                {data: 'image', name: 'image'},
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            order: [[6, 'desc']],
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function () {
            articlesTable.search(this.value).draw();
        })


        $('#category').on('change', function () {
            category = this.value;
            $("input[name=category_id]").val($(this).val());
            articlesTable.ajax.reload();
        })
    </script>

@endpush
