
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ __('admin.dashboard') }}</title>
    <meta content="" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="{{ asset('dashboard/assets_ar/images/favicon.ico') }}">

    @if (app()->getLocale() == 'ar')
    <link href="{{asset('dashboard/assets_ar/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dashboard/assets_ar/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dashboard/assets_ar/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dashboard/assets_ar/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dashboard/assets_ar/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dashboard/assets_ar/css/style.css')}}" rel="stylesheet" type="text/css">

    @endif
    @if (app()->getLocale() == 'en')
    <link href="{{asset('dashboard/assets_en/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dashboard/assets_en/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dashboard/assets_en/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dashboard/assets_en/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dashboard/assets_en/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dashboard/assets_en/css/style.css')}}" rel="stylesheet" type="text/css">
    @endif
    @toastr_css
</head>
