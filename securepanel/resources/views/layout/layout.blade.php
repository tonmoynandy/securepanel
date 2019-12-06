<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/table.css')}}" rel="stylesheet" type="text/css" />
    
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet" type="text/css" />
    
    
    <title>{{ env('APP_NAME') }}</title>
</head>

<body>
    <div class="main-container">

        <div class="container-area">
            <div class="sidenav open">
                @include('layout.header')
                @include('layout.sidebar')
            </div>
            <div class="content-area">
                <div class="child scrollable">
                    <nav class="heading-nav navbar navbar-light bg-light">
                        <a class="navbar-brand" href="#">
                            <i class="fa @yield('page_icon')"></i>
                        @yield('page_name')</a>
                        @stack('add_menu')
                    </nav>

                    <div class="card">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('layout.footer')
    </div>
    @stack('scripts')
    <script src="{{asset('js/tab.js')}}"></script>
    <link href="{{asset('css/tab.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    <link href="{{asset('css/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
    
</body>
</html>
