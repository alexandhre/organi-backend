@include('layouts\_includes\topo')
@include('layouts\_includes\header')
<body id="page-top">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div id='wrapper'>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @yield('content')               
            </div>
        </div>
        @include('layouts\_includes\footer')
        @yield('scripts')
    </div>
</body>
