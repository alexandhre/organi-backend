@include('layouts\_includes\topoNovo')
@include('layouts\_includes\headerNovo')
<body id="page-top">
<meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('content')
        @include('layouts\_includes\footer')
        @yield('scripts')
</body>
