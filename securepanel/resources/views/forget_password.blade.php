<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css" />
    
    @stack('scripts')
    <title>{{ env('APP_NAME') }}</title>
<body>
    <div class="main-container">
        <div class="login-panel">
            <div class="logo-panel">    
                <img class="logo" src="{{ asset('images/logo.png') }}"/>
            </div>
            <form action="{{ \URL::route('forget_password_action') }}" method="post">
                @if(\Session::has('success')) 
                <div class="alert alert-success">
                    <div>{{\Session::get('success')}}</div>
                </div>
                @endif
                @if ($errors->all() || \Session::has('error'))
                <div class="alert alert-danger">
                    @if(\Session::has('error'))
                        <div>{{\Session::get('error')}}</div>
                    @endif
                    @foreach($errors->all() as $error)
                        <div>{{$error}}</div>
                    @endforeach
                </div>
                @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email"/>
                    </div>
                  
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <input type="submit" name="send" value="Send" class="btn btn-primary btn-md" />
                        </div>
                       
                    </div>
                
            </form>
        </div>
    </div>
</body>
</html>
