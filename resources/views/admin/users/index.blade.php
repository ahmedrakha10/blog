@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Users')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item">{{__('Users')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i>
                            {{__('Create User')}}</a>

                        @if(auth()->user()->id ==1)
                            <form method="post" action="{{ route('admin.users.bulk_delete') }}"
                                  style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="record_ids" id="record-ids">
                                <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i
                                        class="fa fa-trash"></i>
                                    {{__('Bulk delete')}}</button>
                            </form>
                        @endif

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus
                                   placeholder="{{__('Search')}}">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="users-table" style="width: 100%;">
                                <thead>
                                <tr>
                                    @if(auth()->user()->id ==1)
                                        <th>
                                            <div class="animated-checkbox">
                                                <label class="m-0">
                                                    <input type="checkbox" id="record__select-all">
                                                    <span class="label-text"></span>
                                                </label>
                                            </div>
                                        </th>
                                    @endif
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
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

        let usersTable = $('#users-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.users.data') }}',
            },
            columns: [
                @if(auth()->user()->id == 1)
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                @endif
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            @if(auth()->user()->id == 1) order: [[3, 'desc']],
            @else                        order: [[2, 'desc']],
            @endif
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function () {
            usersTable.search(this.value).draw();
        })
    </script>

@endpush
