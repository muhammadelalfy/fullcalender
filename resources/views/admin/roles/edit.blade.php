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
                        <li class="breadcrumb-item"><a href="{{route('adminhome')}}">{{ __('admin.home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('admin.roles') }}</li>
                    </ol>
                </div>
            </div> <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <form action="" id="roles" method="POST" data-parsley-validate>
                                @csrf
                                @method('put')

                                <input type="hidden" name="roleId" id="role_id" value="{{$role->id}}" class="form-control">
                                <div class="form-group row">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">{{ __('admin.rolename') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="name"
                                            id="example-text-input" placeholder="{{ __('admin.rolename') }}" value="{{$role->name}}" required>
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

                                            @foreach($models as $index=>$model)
                                            @if($model == 'settings')
                                            <?php $actions = ['read', 'update']; ?>
                                            @endif
                                            @if($model == 'abouts')
                                            <?php $actions = ['read', 'update']; ?>
                                            @endif
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td>{{__('admin.'.$model)}}</td>
                                                <td class="col-sm-8 col-xl-4 m-b-30">
                                                        @foreach($actions as $index=>$action)
                                                        <label for="">{{__('admin.'.$action)}}</label>
                                                        <input type="checkbox" name="permissions[]" value="{{$model.'-'.$action}}" {{$role->hasPermission($model.'-'.$action) ? 'checked':''}} />
                                                        @endforeach

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group text-center m-t-20">
                                    <div class="col-12">
                                        {{-- <a href="{{url()->previous()}}"> --}}
                                        <button class="btn btn-primary btn-block btn-lg" name="submit"
                                            type="submit">{{ __('admin.edit') }}</button>
                                        {{-- </a> --}}
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

            $('body').on('submit','#roles',function (e) {
                e.preventDefault();
                //  alert('asdasd');
                 let id = $('#role_id').val();
                 var url = '{{ route('roles.update', ':id') }}';
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
                        window.location = "{{route('roles.index')}}";
                        toastr['info']("{{ __('admin.updatedsuccess') }}");
                        }
                    },

                });
            });

        });
 </script>
@endpush
