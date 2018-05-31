<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 1001; max-height: 55px;">
    @if(Auth::check())
        <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
    @endif
    <div class="container">
        <a class="logo" href="{{ '/' }}" title="Pagrindinis"><img style="max-height: 55px;" src="//poligonas.lt/pluginfile.php/1/theme_essential/logo/1525004899/logo.png" class="img-responsive" alt="Pagrindinis"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

            <ul class="navbar-nav ml-auto">
                @if(Auth::check())
                    <li class="nav-item">
                        <h6 class="navbar-text">Welcome: &nbsp;</h6>
                    </li>
                    <li class="nav-item">
                        <h6 class="navbar-text text-white"><b>{{ Auth::user()->name ? Auth::user()->name : '' }}</b></h6>
                    </li>
                    <li class="nav-item">
                        <h6 class="navbar-text"><a style="padding: 0 0 0 20px" class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">Logout
                            </a></h6>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif

                @if(!Auth::check())
                    <li class="nav-item dropdown @if($errors->hasAny(['register_name', 'register_surname', 'register_email', 'register_password'])){{'show'}}@endif">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" @if($errors->hasAny(['register_name', 'register_surname', 'register_email', 'register_password'])){{'aria-expanded="true"'}}@endif>Register</a>
                        <ul id="login-dp" class="dropdown-menu dropdown-menu-right @if($errors->hasAny(['register_name', 'register_surname', 'register_email', 'register_password'])){{'show'}}@endif">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3><b>Register</b></h3>
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="cols-sm-2 control-label font-weight-bold">Your Name</label>
                                                <input type="text" class="form-control" name="register_name" placeholder="Name" required>
                                                @if($errors->has('register_name'))
                                                    @foreach ($errors->get('register_name') as $error)
                                                        <p class="help-block text-danger">{{ $error }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="cols-sm-2 control-label font-weight-bold">Surname</label>
                                                <input type="text" class="form-control" name="register_surname" placeholder="Surname" required>
                                                @if($errors->has('register_surname'))
                                                    @foreach ($errors->get('register_surname') as $error)
                                                        <p class="help-block text-danger">{{ $error }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="cols-sm-2 control-label font-weight-bold">Phone <i class="font-weight-light text-danger">&nbsp;optional</i></label>
                                                <input type="number" class="form-control" name="register_phone" placeholder="Phone">
                                            </div>
                                            <div class="form-group">
                                                <label class="cols-sm-2 control-label font-weight-bold">Email address</label>
                                                <input type="email" class="form-control" name="register_email" placeholder="Email address" required>
                                                @if($errors->has('register_email'))
                                                    @foreach ($errors->get('register_email') as $error)
                                                        <p class="help-block text-danger">{{ $error }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="cols-sm-2 control-label font-weight-bold">Password</label>
                                                <input type="password" class="form-control" name="register_password" placeholder="Password" required>
                                                @if($errors->has('register_password'))
                                                    @foreach ($errors->get('register_password') as $error)
                                                        <p class="help-block text-danger">{{ $error }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="cols-sm-2 control-label font-weight-bold">Password</label>
                                                <input type="password" class="form-control" name="register_password_confirmation" placeholder="Repeat Password" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>

                    {{--Cia pakeisti--}}
                    <li class="nav-item dropdown @if($errors->hasAny(['login_email', 'login_password'])){{'show'}}@endif">
                        {{--Cia--}}
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" @if($errors->hasAny(['login_email', 'login_password'])){{'aria-expanded="true"'}}@endif>Login</a>
                        {{--Cia--}}
                        <ul id="login-dp" class="dropdown-menu dropdown-menu-right @if($errors->hasAny(['login_email', 'login_password'])){{'show'}}@endif">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3><b>Login</b></h3>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="sr-only">Email address</label>
                                                <input type="text" class="form-control" name="login_email" placeholder="Email address" required>
                                                @if($errors->has('login_email'))
                                                    @foreach ($errors->get('login_email') as $error)
                                                        <p class="help-block text-danger">{{ $error }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only">Password</label>
                                                <input type="password" class="form-control" name="login_password" placeholder="Password" required>
                                                <div class="help-block text-right"><a href="">Forgot the password ?</a></div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Log in</button>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> keep me logged-in
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
