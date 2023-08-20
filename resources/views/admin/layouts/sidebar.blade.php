        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu">

                        <li class="menu-title">{{ __('admin.menu') }}</li>
                        <li>
                            <a href="{{ route('adminhome') }}" class="waves-effect">
                                <i class="icon-accelerator"></i><span class="badge badge-success badge-pill float-right"></span> <span> {{ __('admin.dashboard') }} </span>
                            </a>
                        </li>
                        @if(Auth::guard('admin')->user()->hasPermission('roles-read'))
                        <li>
                            <a href="{{route('roles.index')}}" class="waves-effect">
                                <i class="fas fa-user-lock"></i><span>{{ __('admin.roles') }}</span>
                            </a>
                        </li>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermission('admins-read'))
                        <li>
                            <a href="{{route('admins.index')}}" class="waves-effect">
                                <i class="fas fa-user-tag"></i><span>{{ __('admin.administrators') }}</span>
                            </a>
                        </li>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermission('users-read'))
                        <li>
                            <a href="{{route('users.index')}}" class="waves-effect">
                                <i class="fas fa-users"></i><span>{{ __('admin.users') }}</span>
                            </a>
                        </li>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermission('countries-read'))
                        <li>
                            <a href="{{ route('countries.index') }}" class="waves-effect">
                                <i class="fas fa-flag"></i><span class="badge badge-success badge-pill float-right"></span> <span> {{ __('admin.countries') }} </span>
                            </a>
                        </li>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermission('settings-read'))
                        <li>
                            <a href="{{route('settings.index')}}" class="waves-effect">
                                <i class="fas fa-cog"></i><span>{{ __('admin.settings') }}</span>
                            </a>
                        </li>
                        @endif
                    </ul>

                </div>
                <!-- Sidebar -->
                {{-- <div class="clearfix"></div> --}}

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->
