@extends('admin.layouts.master')
@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">{{ __('admin.administrators') }}</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{route('adminhome')}}">{{ __('admin.home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('admin.administrators') }}</li>
                    </ol>
                </div>
            </div> <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <form action="" id="admins" method="POST" data-parsley-validate>
                                @csrf
                                @method('put')

                                <input type="hidden" name="adminId" id="admin_id" value="{{$admin->id}}" class="form-control">
                                <div class="form-group row">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">{{ __('admin.name') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="name"
                                            id="example-text-input" placeholder="{{ __('admin.name') }}" value="{{$admin->name}}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">{{ __('admin.email') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email" name="email"
                                            id="example-text-input" placeholder="{{ __('admin.email') }}" value="{{$admin->email}}" required>
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
                                    <label class="col-sm-2 col-form-label">@lang('admin.role')</label>
                                    <div class="col-sm-10">
                                        <select class="form-control form-control-round" name="role_id" id="role_id" required>
                                        <option value="">---</option>
                                        @foreach($roles as $role)
                                        <option  value="{{$role->id}}" {{$admin->hasRole($role->name) == 'true'? 'selected':''}}>{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-center m-t-20">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block btn-lg" name="submit"
                                            type="submit">{{ __('admin.edit') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
</div>


@endsection
@push('js')
<script>
    $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('submit','#admins',function (e) {
                e.preventDefault();
                //  alert('asdasd');
                 let id = $('#admin_id').val();
                 var url = '{{ route('admins.update', ':id') }}';
                 url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    method: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache       : false,
                    contentType : false,
                    processData : false,

                    success: function (response) {
                        // console.log(response);
                        if(response.status == 'success'){
                            toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "showDuration": 500,
                            // "rtl": isRtl
                        }
                        window.location = "{{route('admins.index')}}";
                        toastr['info']("{{ __('admin.updatedsuccess') }}");
                        }
                    },

                });
            });

        });
 </script>
@endpush
