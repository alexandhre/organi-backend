@include('layouts\_includes\topo')
@include('layouts\_includes\header')
<body id="page-top">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div id='wrapper' class="col-md-12 row" >
        <div id="content-wrapper" class="col-md-12">
            <div id="content">
                @yield('content')               
            </div>
        </div>
     </div>
        @include('layouts\_includes\footer')
        @yield('scripts')
</body>
