<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="{{ auth()->user()->avatar }}" class="user-image img-circle elevation-2" style="object-fit:cover;"
            alt="{{ auth()->user()->name }}">
        <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <li class="user-header bg-primary">
            <img src="{{ auth()->user()->avatar }}" class="img-circle elevation-2" style="object-fit:cover;"
                alt="{{ auth()->user()->name }}">
            <p>
                {{ auth()->user()->name }}
                <small>{{ ucfirst(auth()->user()->role) }}</small>
            </p>
        </li>
        <li class="user-footer">
            <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">
                <i class="fas fa-user-circle mr-1"></i> Profil
            </a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-default btn-flat float-right">
                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</li>
