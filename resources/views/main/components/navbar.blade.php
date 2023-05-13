<nav class="navbar navbar-expand-lg bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Pilihaken!</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                @if (auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/user">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/vote">Vote</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
