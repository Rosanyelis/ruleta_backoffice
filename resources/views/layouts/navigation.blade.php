
<div class="left-side-menu">
    <div class="media user-profile mt-2 mb-2">
        <img src="{{ asset('assets/images/users/avatar-7.jpg') }}" class="avatar-sm rounded-circle mr-2" alt="Shreyu" />
        <img src="{{ asset('assets/images/users/avatar-7.jpg') }}" class="avatar-xs rounded-circle mr-2" alt="Shreyu" />

        <div class="media-body">
            <h6 class="pro-user-name mt-0 mb-0">{{ Auth::user()->nombre }}</h6>
            <span class="pro-user-desc">{{ Auth::user()->rol }}</span>
        </div>
        <div class="dropdown align-self-center profile-dropdown-menu">
            <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span data-feather="chevron-down"></span>
            </a>
            <div class="dropdown-menu profile-dropdown">
                <a href="pages-profile.html" class="dropdown-item notify-item">
                    <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                    <span>Mi cuenta</span>
                </a>

                <div class="dropdown-divider"></div>
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                        <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                        <span>Cerrar Sesion</span>
                    </a>
                </form>
            </div>
        </div>
    </div>
    <div class="sidebar-content">
        <!--- Sidemenu -->
        <div id="sidebar-menu" class="slimscroll-menu">
            <ul class="metismenu" id="menu-bar">
                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ url('/dashboard') }}">
                        <i class="uil uil-home-alt"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li class="menu-title">Grupos</li>
                <li>
                    <a href="{{ url('/responsables') }}">
                        <i class="uil uil-user-square"></i>
                        <span> Responsables </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/clientes') }}">
                        <i class="uil uil-user-square"></i>
                        <span> Clientes </span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="uil uil-airplay"></i>
                        <span> Taquillas </span>
                    </a>
                </li>
                <li class="menu-title">Plantillas</li>
                <li>
                    <a href="{{ url('/plantilla-de-ruletas') }}">
                        <i class="uil uil-compact-disc"></i>
                        <span> Ruletas </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/plantilla-de-jugadas') }}">
                        <i class="uil uil-game"></i>
                        <span> Jugadas </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/plantilla-de-horarios') }}">
                        <i class="uil uil-clock-eight"></i>
                        <span> Horarios </span>
                    </a>
                </li>
                <li class="menu-title">Configuraciones</li>
                <li>
                    <a href="{{ url('/usuarios') }}">
                        <i class="uil uil-users-alt"></i>
                        <span> Usuarios </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>


