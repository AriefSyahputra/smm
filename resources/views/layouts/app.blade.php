<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body>
    @if (!request()->is('login'))
        @include('layouts.header')
        @include('layouts.sidebar')
    @endif

    @yield('content')

    <!-- Vendor JS Files -->
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
    <script src="{{ asset('/vendor/ckeditor/ckeditor.js') }} "></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/js/utils.js') }}"></script>
    {{-- -------------------- --}}

    <!-- jQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- DataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <!-- Datepicker -->
    <script type="text/javascript" src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

    <!-- Select2 -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- sweetalert2 -->
    <script type="text/javascript" src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js "></script>

    @yield('js')
</body>

</html>
