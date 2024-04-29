<!-- header -->
@include('admin.layouts.header')
<body>
    <!-- Preloader start -->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!-- Preloader end -->

    <!-- Main wrapper start -->
    <div id="main-wrapper">
        <!-- nabar -->
        @include('admin.layouts.navbar')
        <!-- sidebar -->
        @include('admin.layouts.sidebar')

                @yield('content')

        <!-- footer -->
        @include('admin.layouts.footer')
    </div>
    <!-- Main wrapper end -->

    <!-- Scripts -->
    @include('admin.layouts.scripts')

</body>
</html>