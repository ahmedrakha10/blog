<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" style="font-family: 'Cairo', 'sans-serif';" href="{{ route('admin.home') }}">{{__('Blog')}}</a>

    <!-- Sidebar toggle button-->
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>

    <!-- Navbar Right Menu-->
    <ul class="app-nav">

        {{--user menu--}}
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item" href="page-login.html" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-lg"></i>
                       {{__('Logout')}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</header>
