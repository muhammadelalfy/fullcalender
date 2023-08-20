@extends('admin.layouts.master')

@section('content')
    <div class="content">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">{{ __('admin.administrators') }}</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminhome') }}">{{ __('admin.home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('admin.administrators') }}</li>
                    </ol>
                </div>
            </div> <!-- end row -->
            <br>
            <div class="row align-items-center">
                @if(Auth::guard('admin')->user()->hasPermission('admins-create'))
                <div class="text-center">
                    <!-- Large modal -->
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                        data-target="#modal-add-admin" style="margin-right: 20px;margin-left: 20px;"><i
                            class="fas fa-plus-circle" style="padding-inline-end: 5px;"></i>{{ __('admin.add') }}
                        {{ __('admin.administrative') }}</button>
                </div>
                @endif
                <!--  Modal content for the above example -->
                <div class="modal fade modal-add-admin" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                    aria-hidden="true" id="modal-add-admin">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myLargeModalLabel">{{ __('admin.add') }}
                                    {{ __('admin.administrative') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    data-target="#modal-add-admin">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body" id="modal-add-admin">
                                <div class="modal-body">
                                    <div class="card-body">
                                        <form id="addadmin" method="POST" data-parsley-validate>
                                            @csrf
                                            @method('post')

                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                    class="col-sm-2 col-form-label">{{ __('admin.name') }}</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" value="{{ old('name') }}" type="text"
                                                        name="name" id="example-text-input"
                                                        placeholder="{{ __('admin.name') }} " required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">{{ __('admin.email') }}</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="email" type="email"
                                                        id="example-text-input" placeholder="{{ __('admin.email') }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">{{ __('admin.password') }}</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="password" type="password"
                                                        id="example-text-input" placeholder="{{ __('admin.password') }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">{{ __('admin.role') }}</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control form-control-round" name="role_id" id="role_id" required>
                                                    <option value="">---</option>
                                                    @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group text-center m-t-20">
                                                <div class="col-12">
                                                    <button class="btn btn-primary btn-block btn-lg" name="submit"
                                                        type="submit">{{ __('admin.add') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div> <!-- end row -->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                        <table id="datatable" class="table table-bordered dt-responsive nowrap yajra-datatable"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('admin.name') }}</th>
                                    <th>{{ __('admin.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- end col -->
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
                    ajax: "{{ route('admins.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });
            } else {
                var table = $('.yajra-datatable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/English.json"
                    },
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admins.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });
            }

        });
    </script>
    <script>
        $('body').on('submit', '#addadmin', function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('admins.store') }}',
                method: "post",
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "showDuration": 500,
                            // "rtl": isRtl
                        }
                        toastr['success']("{{ __('admin.addsuccess') }}");
                    }
                    $('#datatable').DataTable().ajax.reload();
                    $("#addadmin").trigger("reset");
                    $('#modal-add-admin .close').click();
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
