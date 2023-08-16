<html>
    <head>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        
    </head>

    <body>

    <nav class="#0277bd light-blue darken-3">
            <div class="nav-wrapper">
            <a href="#" class="brand-logo">Blog-API</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">

                @if (Route::has('login'))
                        @auth
                        <li><a href="{{ url('/home') }}">Home</a></li>
                        @else
                        <li><a href="{{ route('login') }}">Login</a></li>

                            @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">Register</a></li>
                            @endif
                        @endauth
                @endif
            </ul>
            
            </div>
        </nav>
        <br>
        <div class="row">
            <form class="col s4 offset-s4" method="post" action="{{ route('register') }}">
                <div class="row">
                    <div class="input-field">
                        <input id="email" type="email" class="validate">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="row">

                    <div class="input-field col s12">
                        <div class="row">
                            <div class="input-field">
                                <input id="password" type="password" class="validate">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <input id="password" type="password" class="validate">
                                <label for="password">Confirm Password</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                    <button class="btn waves-effect waves-light light-blue accent-4" type="submit" name="action">Register
                        <i class="material-icons right">send</i>
                    </button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>