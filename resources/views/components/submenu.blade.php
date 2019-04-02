@isset($childern)
    @if(count($childern)>0)
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            @foreach($childern as $child)
            <a class="dropdown-item" href="{{ asset($child->adresa) }}">{{ $child->naziv }}</a>
                @foreach($menus as $menu)
                    @if($menu->id == $child->id)
                        @component('components.submenu',[ 'children'=>$menu->submenus,
                                                'menus'=>$menus])
                        @endcomponent
                        @endif
                    @endforeach
            @endforeach
        </div>

        @endif
    @endisset