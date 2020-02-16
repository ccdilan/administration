<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cyntrek Admin</title>

    <link rel="stylesheet" href="{{asset('vendors/iconfonts/font-awesome/css/all.min.css')}}">
    {{--    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">--}}
    {{--    <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">--}}

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @stack('styles')
</head>
<body>
<div class="container-scroller">
    @include('layouts.includes.top')
    <div class="container-fluid page-body-wrapper">
        @include('layouts.includes.side')
        <div class="main-panel">
            @yield('content', 'Default Content')
            @include('layouts.includes.footer')
        </div>

    </div>
</div>


<script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{asset('vendors/js/vendor.bundle.addons.js')}}"></script>
<script src="{{asset('js/off-canvas.js')}}"></script>
<script src="{{asset('js/hoverable-collapse.js')}}"></script>
<script src="{{asset('js/misc.js')}}"></script>
<script src="{{asset('js/settings.js')}}"></script>
<script src="{{asset('js/todolist.js')}}"></script>
<script src="{{asset('js/dashboard.js')}}"></script>

<script src="{{asset('js/notifications.js')}}"></script>
<script src="{{asset('js/modal.js')}}"></script>
<script src="{{asset('js/dataTable.js')}}"></script>
<script src="{{asset('js/FormOptions.js')}}"></script>
<script>
        @if(Session::has('message'))
    let type = "{{ Session::get('alert-type', 'info') }}";
    let msg = "{{ Session::get('message') }}";
    switch (type) {
        case 'info':
            Notifications.showSuccessMsg(msg);
            break;
        case 'warning':
            Notifications.showSuccessMsg(msg);
            break;
        case 'success':
            Notifications.showSuccessMsg(msg);
            break;
        case 'error':
            Notifications.showErrorMsg(msg);
            break;
    }
    @endif
</script>
@stack('scripts')
</body>


</html>
