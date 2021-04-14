@include('layouts._head_table')
<body>
        @include('layouts._nav_table')
        <main class="">
            @yield('content')
        </main>
</body>
	@yield('scripts')
    @include('layouts._footer')
</html>
