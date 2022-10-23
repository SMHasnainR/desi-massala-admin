@extends('admin.layouts.app')

@section('auth')


    @if (\Request::is('static-sign-in'))
        {{-- @include('admin.layouts.navbars.guest.nav') --}}
            @yield('content')
        {{-- @include('admin.layouts.footers.guest.footer') --}}
    @else
        @if (\Request::is('rtl'))
            @include('admin.layouts.navbars.auth.sidebar-rtl')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
                @include('admin.layouts.navbars.auth.nav-rtl')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('admin.layouts.footers.auth.footer')
                </div>
            </main>
        @elseif (\Request::is('profile'))
            @include('admin.layouts.navbars.auth.sidebar')
            <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
                @include('admin.layouts.navbars.auth.nav')
                @yield('content')
            </div>
        @else
            @include('admin.layouts.navbars.auth.sidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
                @include('admin.layouts.navbars.auth.nav')
                <div class="container-fluid py-4">

                    @if (session('success'))
                        <div class="d-flex alert alert-success status-box alert-dismissable fade show justify-content-between" role="alert">
                            <span>
                                {{ session('success') }}
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="d-flex alert alert-danger status-box alert-dismissable fade show justify-content-between" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;<span class="sr-only">Close</span></a>
                            <span>
                                {{ session('error') }}
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    @endif

                    @yield('content')
                    @include('admin.layouts.footers.auth.footer')
                </div>
            </main>
        @endif

        @include('components.fixed-plugin')
    @endif



@endsection
