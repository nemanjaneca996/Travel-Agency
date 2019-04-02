<div class="row header">
    <div class="col-md-8">
        <h1 class="naslov"><a href="{{ asset('/') }}" class="font-italic">TRAVEL AGENCY</a></h1>
    </div>
    <div class="col-md-4 text-right">
        @if(session()->has('user'))
                <a href="{{ route('logout') }}">Logout</a>
            @if(session()->get('user')[0]->naziv=='admin')
                <br/><a href="{{ route('admin') }}">Admin panel</a>
                @else
                <br/><a href="{{ route('rezervacije') }}">Rezervacije</a>
                @endif
            @else
                <a href="{{ route('registracija') }}">Login/Registration</a>
        @endif
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light navigacija">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            @foreach($menus as $menu)
                @if($menu->parent == 0)
                        @if(isset($menu->submenus[0]))
                        <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="{{ asset($menu->adresa) }}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $menu->naziv }}</a>
                        @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ asset($menu->adresa) }}">{{ $menu->naziv }}</a>
                            @endif
                        @component('components.submenu',[ 'childern'=>$menu->submenus,
                                                'menus'=>$menus])
                            @endcomponent
                    </li>
                    @endif
                @endforeach
        </ul>
    </div>
</nav>