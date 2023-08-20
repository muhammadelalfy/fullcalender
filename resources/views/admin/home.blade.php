@extends('admin.layouts.master')
@section('content')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h4 class="page-title">{{ __('admin.dashboard') }}</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item"><a href="{{ route('adminhome') }}">{{ __('admin.home') }}</a></li>
                                    <li class="breadcrumb-item">{{ __('admin.dashboard') }}</li>
                                </ol>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end page-title -->

                    <div class="row">

                        <div class="col-sm-6 col-xl-4">
                            <div class="card">
                                <div class="card-heading p-4">
                                    <div class="mini-stat-icon float-right">
                                        <i class="mdi mdi-cube-outline bg-primary  text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-16">Active Sessions</h5>
                                    </div>
                                    <h3 class="mt-4">43,225</h3>
                                    <div class="progress mt-4" style="height: 4px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="text-muted mt-2 mb-0">Previous period<span class="float-right">75%</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-4">
                            <div class="card">
                                <div class="card-heading p-4">
                                    <div class="mini-stat-icon float-right">
                                        <i class="mdi mdi-briefcase-check bg-success text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-16">Total Revenue</h5>
                                    </div>
                                    <h3 class="mt-4">$73,265</h3>
                                    <div class="progress mt-4" style="height: 4px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 88%" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="text-muted mt-2 mb-0">Previous period<span class="float-right">88%</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-4">
                            <div class="card">
                                <div class="card-heading p-4">
                                    <div class="mini-stat-icon float-right">
                                        <i class="mdi mdi-buffer bg-danger text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-16">Add to Card</h5>
                                    </div>
                                    <h3 class="mt-4">86%</h3>
                                    <div class="progress mt-4" style="height: 4px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="text-muted mt-2 mb-0">Previous period<span class="float-right">82%</span></p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- container-fluid -->

            </div>
            <!-- content -->
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
@endsection
