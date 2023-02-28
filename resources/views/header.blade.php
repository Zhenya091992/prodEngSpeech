<nav class="shadow-lg navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse container-fluid" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('main') }}">Main</a>
                </li>
            </ul>
        </div>
        <div class="d-flex float-right">
            <a class="nav-link" aria-current="page" href="{{ route('loginForm') }}">Sign in</a>
        </div>
        <div class="d-flex float-right">
            <a class="nav-link" aria-current="page" href="{{ route('registerForm') }}">Registration</a>
        </div>
    </div>
</nav>
