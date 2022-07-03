<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="imagem/png" href="" />
    <title> Clínica </title>
    {{-- BootStrap --}}
    {{--
        <link href="{{ URL::asset('/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css">

    <link href="{{ URL::asset('/css/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    {{--
        <link href="{{ URL::asset('/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    --}}

    <!-- App Css-->
    {{--
        <link href="{{ URL::asset('/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    --}}
    {{-- Libs --}}

    {{-- jQuery--}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Ajax--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- DataTables --}}
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

    @yield('style')
</head>

<body>
    @include('templates.layouts.menu')
   

    <section id="content">
        @yield('content')
    </section>
    <input type="hidden" id="jwttoken"  value="{{session('jwt-token')->original['access_token']}}">


    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/24eb5c67e7.js" crossorigin="anonymous"></script>

    {{-- BootStrap --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    {{-- Libs --}}

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        });

        function clearLink() {
            window.history.pushState("", "", "/");
        }

        function goBack() {
            window.history.back();
        }
    </script>

    @yield('javascript')

</body>
</html>
