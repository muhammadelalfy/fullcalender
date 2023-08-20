@extends('admin.layouts.master')
@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">{{ __('admin.settings') }}</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminhome') }}">{{ __('admin.home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('admin.settings') }}</li>
                    </ol>
                </div>
            </div> <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <form action="" id="settings" method="POST" data-parsley-validate>
                                @csrf
                                @method('put')
                                <input type="hidden" name="settingId" id="setting_id" value="{{$setting->id}}" class="form-control">
                                <div class="form-group row">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">{{ __('admin.name_ar') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{ $setting->name_ar }}" type="text"
                                            name="name_ar" id="example-text-input"
                                            placeholder="{{ __('admin.name_ar') }} " required parsley-trigger="change" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">{{ __('admin.name_en') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{ $setting->name_en }}"
                                            name="name_en" id="example-text-input"
                                            placeholder="{{ __('admin.name_en') }}" required parsley-trigger="change" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">{{ __('admin.phone') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{ $setting->phone }}"
                                            name="phone" id="example-text-input"
                                            placeholder="{{ __('admin.phone') }}" required parsley-trigger="change" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">{{ __('admin.email') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{ $setting->email }}"
                                            name="email" id="example-text-input"
                                            placeholder="{{ __('admin.email') }}" required parsley-trigger="change" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">{{ __('admin.facebook') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{ $setting->facebook }}"
                                            name="facebook" id="example-text-input"
                                            placeholder="{{ __('admin.facebook') }}" required parsley-trigger="change" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">{{ __('admin.twitter') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{ $setting->twitter }}"
                                            name="twitter" id="example-text-input"
                                            placeholder="{{ __('admin.twitter') }}" required parsley-trigger="change" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">{{ __('admin.linkedin') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{ $setting->linkedin }}"
                                            name="linkedin" id="example-text-input"
                                            placeholder="{{ __('admin.linkedin') }}" required parsley-trigger="change" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">{{ __('admin.instagram') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{ $setting->instagram }}"
                                            name="instagram" id="example-text-input"
                                            placeholder="{{ __('admin.instagram') }}" required parsley-trigger="change" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">{{ __('admin.address_ar') }}</label>
                                    <div class="col-sm-10">
                                     <textarea class="form-control"  name="address_ar" id="" cols="10" rows="10">{!! $setting->address_ar !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">{{ __('admin.address_en') }}</label>
                                    <div class="col-sm-10">
                                     <textarea class="form-control"  name="address_en" id="" cols="10" rows="10">{!! $setting->address_en !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">{{ __('admin.image') }}</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="image" id="image" value="{{$setting->image}}"  class="filestyle image" data-buttonname="btn-primary" >
                                        <img src="{{ asset('dashboard/' . $setting->image) }}"
                                        width="340" height="200" alt=""
                                        style="margin-right: 70px;border-radius: 15px;"
                                        class="image-show"/>
                                    </div>
                                </div>
                                @if(Auth::guard('admin')->user()->hasPermission('settings-update'))
                                <div class="form-group text-center m-t-20">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block btn-lg" name="submit"
                                            type="submit">{{ __('admin.edit') }}</button>
                                    </div>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
                <a href="{{url()->previous()}}">
                    <button class="btn btn-primary">{{ __('admin.return') }} <i class="fas fa-backward"></i></button>
                </a>
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

            $('body').on('submit','#settings',function (e) {
                e.preventDefault();
                //  alert('no problem');
                 let id = $('#setting_id').val();
                 var url = '{{ route('settings.update', ':id') }}';
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
                        toastr['info']("{{ __('admin.updatedsuccess') }}");
                        }
                    },

                });
            });

        });
 </script>

<script>
    // image preview

    $(".image").change(function() {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.image-show').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

    $(".image_owner").change(function() {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.image_owner-show').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endpush
