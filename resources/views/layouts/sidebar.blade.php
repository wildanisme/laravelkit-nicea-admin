<ul class="sidebar-nav" id="sidebar-nav">
    @foreach (json_decode(MenuHelper::Menu()) as $menu)
        <li class="nav-header">{{ strtoupper($menu->nama_menu) }}</li>
        @foreach ($menu->submenus as $submenu)
            @if (count($submenu->submenus) == '0')
                <li class="nav-item">
                    <a class="{{ Request::segment(1) == $submenu->url ? 'nav-link' : 'nav-link collapsed' }}"
                        href="{{ url($submenu->url) }}">
                        <i class="bi bi-grid"></i>
                        <span>{{ ucwords($submenu->nama_menu) }}</span>
                    </a>
                </li>
            @else
                @foreach ($submenu->submenus as $url)
                    @php
                        $urls[] = $url->url;
                    @endphp
                @endforeach
                {{-- {{-- --}}
                <li class="nav-item">
                    <a class="{{ in_array(Request::segment(1), $urls) ? 'nav-link ' : 'nav-link collapsed' }}"
                        data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>{{ $submenu->nama_menu }}</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav"
                        class="nav-content collapse {{ in_array(Request::segment(1), $urls) ? 'show' : '' }}"
                        data-bs-parent="#sidebar-nav">
                        @foreach ($submenu->submenus as $endmenu)
                            <li>
                                <a href="{{ url($endmenu->url) }}"
                                    class="{{ Request::segment(1) == $endmenu->url ? 'active' : '' }}">
                                    <i class="bi bi-circle"></i><span>{{ ucwords($endmenu->nama_menu) }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    @endforeach
</ul>
