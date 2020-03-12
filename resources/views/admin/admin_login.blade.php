<!DOCTYPE html>
<html lang="en">
    
    <head>
        <title>Soyen Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/backend_css/soyen_login.css') }}" />
        <link href="{{ asset('fonts/css/all.min.css') }}" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox"> 
            @if(Session::has('flash_message_error'))   
                
                <div class="alert alert-danger alert-dismissable fade show" role="alert">
                    <span class="alert-heading">Opp! Something is wrong!</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <hr>
                    <p class="mb-0">{!! session('flash_message_error') !!}</p>
                </div>
                
            @endif   
            
            @if(Session::has('flash_message_success'))   
                
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>  
                    <strong class="mb-0">{!! session('flash_message_success') !!}</strong>                  
                </div>
                
            @endif 

            <form class="form-signin" id="loginform" method="post" action="{{ url('/admin') }}" >
                @csrf
                <img class="mb-4" src="" alt="Soyen Admin Logo" width="72" height="72">

                <h1 class="h4 mb-3 font-weight-normal">Please sign in</h1>

                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" name="email" id="inputEmail" class="form-control my-3" placeholder="Email address" required autofocus>
                
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                
                <div class="checkbox mb-3 my-2">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                
                <button class="btn btn-lg btn-primary btn-block rounded-pill" type="submit">Sign in</button>
                
            </form>
        </div>

        <footer class="container fixed-bottom">
            <p class="mt-5 mb-3 text-muted text-center">&copy; 2020</p>
        </footer>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('js/backend_js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/backend_js/popper.js') }}" ></script>
        <script src="{{ asset('js/backend_js/bootstrap.min.js') }}" ></script>
        <script src="{{ asset('js/backend_js/soyen.login.js') }}"></script> 
    </body>

</html>
