<nav class="navbar navbar-expand-lg" color-on-scroll="500" style="width: auto; height:71px">
    <div class=" container-fluid  ">
        <a class="navbar-brand"> {{ session('header_text') }} </a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">

            <ul class="navbar-nav ml-auto">
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item dropdown">

                        <a class="nav-link" href="{{ url('/') }}" id="navbarDropdownMenuLink"
                           aria-haspopup="true" aria-expanded="false">
                            <span class="no-icon">{{ Auth::user()->name }}</span>
                        </a>
                        <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}" >
                            <span class="no-icon " >Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>


                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>