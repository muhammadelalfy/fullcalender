<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ __('admin.adminlogin') }}</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="{{ asset('dashboard/assets_en/images/favicon.ico') }}">
    @if (app()->getLocale() == 'en')
    <link href="{{ asset('dashboard/assets_en/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/assets_en/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/assets_en/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/assets_en/css/style.css') }}" rel="stylesheet" type="text/css">
    @endif
    @if (app()->getLocale() == 'ar')
    <link href="{{ asset('dashboard/assets_ar/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/assets_ar/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/assets_ar/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/assets_ar/css/style.css') }}" rel="stylesheet" type="text/css">
    @endif
    @toastr_css
</head>
<body>
    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="home-btn d-none d-sm-block">
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        @if ($localeCode == LaravelLocalization::getCurrentLocale())
        @elseif($url = LaravelLocalization::getLocalizedURL($localeCode))
        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="text-white"><i class="fas fa-globe h5"></i>
            @if (app()->getLocale() == 'ar')
            <span style="color: #fff;font-family: Tajawal;">English</span>
        @else
            <span style="color: #fff;font-family: Tajawal;">العربية</span>
        @endif
    </a>
        @endif
        @endforeach
    </div>
    <div class="wrapper-page">
        <div class="card card-pages shadow-none">
            <div class="card-body">
                <div class="text-center m-t-0 m-b-15">
                    <h1>{{ __('admin.dashboard') }}</h1>
                </div>
                <h5 class="font-18 text-center">{{ __('admin.signin') }}</h5>
                <form class="form-horizontal m-t-30" method="POST" action="{{route('login.admin')}}">
                    @csrf
                    <div class="form-group">
                        <div class="col-12">
                            <label>{{ __('admin.email') }} : </label>
                            <input class="form-control" type="email" value="{{old('email')}}" name="email"  placeholder="{{ __('admin.email') }}">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">

                            <label>{{ __('admin.password') }} : </label>
                            <input class="form-control input-psswd" id="psswd" psswd-shown="false" type="password" name="password" value="{{ old('password') }}" placeholder="{{ __('admin.password') }}">
                            <br>
                            <button type="button" class="button-psswd btn btn-danger sm fa fa-eye"></button>
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">{{ __('admin.login') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
         <span class="d-none d-sm-inline-block" style="color: #fff">{{ now()->year }} - Crafted with <i class="mdi mdi-heart text-danger"></i> by Green Way</span>.
    </div>
    <!-- END wrapper -->
    @jquery
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function() {

    $('.button-psswd').on('click', function() {

        if ($('.input-psswd').attr('psswd-shown') == 'false') {

            $('.input-psswd').removeAttr('type');
            $('.input-psswd').attr('type', 'text');
            $('.input-psswd').removeAttr('psswd-shown');
            $('.input-psswd').attr('psswd-shown', 'true');
        }else {
            $('.input-psswd').removeAttr('type');
            $('.input-psswd').attr('type', 'password');
            $('.input-psswd').removeAttr('psswd-shown');
            $('.input-psswd').attr('psswd-shown', 'false');
        }

    });

});
    </script>
    <!-- jQuery  -->
    <script src="{{ asset('dashboard/assets_ar/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets_ar/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets_ar/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets_ar/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('dashboard/assets_ar/js/waves.min.js') }}"></script>
    <!-- App js -->
</body>
</html>
