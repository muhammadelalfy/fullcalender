<!DOCTYPE html>
<html>
@include('admin.layouts.head')
<body>
    <!-- Begin page -->
    <div id="wrapper">
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')
        <div class="content-page">
        @yield('content')
        @include('admin.layouts.footer')
        </div>
    </div>
    <!-- END wrapper -->
    @yield('js')
    @include('admin.layouts.script')
</body>
</html>
