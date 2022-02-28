<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{ auth()->user()->image_path ?? '' }}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->name ?? '' }}</p>
        </div>
    </div>

    <ul class="app-menu">

        <li><a class="app-menu__item {{ request()->is('*home*') ? 'active' : '' }}" href="{{ route('admin.home') }}"><i
                    class="app-menu__icon fa fa-home"></i> <span class="app-menu__label">{{__('Home')}}</span></a></li>

        <li><a class="app-menu__item {{ request()->is('*index*') ? 'active' : '' }}" href="{{ route('front.index') }}"><i
                    class="app-menu__icon fa fa-home"></i> <span class="app-menu__label">{{__('Website')}}</span></a></li>

        {{--users--}}
        <li><a class="app-menu__item {{ request()->is('*users*') ? 'active' : '' }}"
               href="{{ route('admin.users.index') }}"><i class="app-menu__icon fa fa-user"></i> <span
                    class="app-menu__label">{{__('Users')}}</span></a></li>

        {{--categories--}}
        <li><a class="app-menu__item {{ request()->is('*categories*') ? 'active' : '' }}"
               href="{{ route('admin.categories.index') }}"><i class="app-menu__icon fa fa-list"></i> <span
                    class="app-menu__label">{{__('Categories')}}</span></a></li>

        {{--Articles--}}
        <li><a class="app-menu__item {{ request()->is('*articles*') ? 'active' : '' }}"
               href="{{ route('admin.articles.index') }}"><i class="app-menu__icon fa fa-newspaper-o"></i> <span
                    class="app-menu__label">{{__('Articles')}}</span></a></li>


        <li>
            <a class="app-menu__item" href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="app-menu__icon fa fa-sign-out fa-lg"></i>
                {{__('Logout')}}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </a>
        </li>

    </ul>
</aside>
