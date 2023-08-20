@extends('admin.layouts.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">{{ __('admin.roles') }}</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminhome') }}">{{ __('admin.home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('admin.roles') }}</li>
                    </ol>
                </div>
            </div> <!-- end row -->
            <br>
            <div class="row align-items-center">
                @if(Auth::guard('admin')->user()->hasPermission('roles-create'))
                    <div class="text-center">
                        <!-- Large modal -->
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                        data-target="#modal-add-role" style="margin-right: 20px;margin-left: 20px;"><i
                            class="fas fa-plus-circle" style="padding-inline-end: 5px;"></i>{{ __('admin.add') }}
                            {{ __('admin.role') }}</button>
                    </div>
                @endif
                <!--  Modal content for the above example -->
                <div class="modal fade modal-add-role" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true" id="modal-add-role">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myLargeModalLabel">{{ __('admin.add') }}
                                    {{ __('admin.role') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                data-target="#modal-add-role">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="modal-add-role">
                                <div class="card-body">
                                    <form id="addrole" method="POST" data-parsley-validate>
                                        @csrf
                                        @method('post')

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">{{ __('admin.rolename') }}</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="name"
                                                    id="example-text-input" placeholder="{{ __('admin.rolename') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>{{ __('admin.part') }}</th>
                                                        <th>{{ __('admin.roles') }}</th>
                                                    </tr>

                                                    @foreach ($models as $index => $model)
                                                        @if ($model == 'settings')
                                                            <?php $actions = ['read', 'update']; ?>
                                                        @endif

                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ __('admin.' . $model) }}</td>
                                                            <td class="col-sm-8 col-xl-4 m-b-30">
                                                                @foreach ($actions as $index => $action)
                                                                    <label for="">{{ __('admin.' . $action) }}</label>
                                                                    <input type="checkbox" name="permissions[]"
                                                                        value="{{ $model . '-' . $action }}" />
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        @if(Auth::guard('admin')->user()->hasPermission('settings-update'))
                                        <div class="form-group text-center m-t-20">
                                            <div class="col-12">
                                                <button class="btn btn-primary btn-block btn-lg" name="submit"
                                                    type="submit">{{ __('admin.add') }}</button>
                                            </div>
                                        </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div> <!-- end row -->
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap yajra-datatable"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('admin.roles') }}</th>
                                        <th>{{ __('admin.action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(function() {
            var locale = '{{ config('app.locale') }}';
            if (locale == 'ar') {
                var table = $('.yajra-datatable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
                    },
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('roles.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {data: 'name', name: 'name',searchable: true, sortable : true},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            } else {
                var table = $('.yajra-datatable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/English.json"
                    },
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('roles.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {data: 'name', name: 'name',searchable: true, sortable : true},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            }

        });
    </script>
    <script>
        $('body').on('submit', '#addrole', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('roles.store') }}',
                method: "post",
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    // debugger;
                    if (response.status == 'success') {
                        // debugger;
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "showDuration": 500,
                            // "rtl": isRtl
                        }
                        toastr['success']("{{ __('admin.addsuccess') }}");
                    }
                    $('#datatable').DataTable().ajax.reload();
                    $("#addrole").trigger("reset");
                    $('#modal-add-role .close').click();
                    $(".modal-backdrop").remove();
                }
            });
        });
    </script>
    <script>
        $('body').on('submit', '#sa-params', function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                method: "delete",
                data: {
                    _token: '{{ csrf_token() }}',
                },

                success: function(response) {
                    if (response.status == 'success') {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "showDuration": 500,
                            // "rtl": isRtl
                        }
                        toastr['error']("{{ __('admin.deletedsuccess') }}");
                    }
                    $('#datatable').DataTable().ajax.reload();
                }
            });
        })
    </script>
@endpush
