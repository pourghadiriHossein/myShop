<div class="top-bar">
    <div class="container">
        <div class="top top-left">
            <div class="sidebar-widget text-left small-screen-center widget_text">
                {{\Hekmatinasser\Verta\Verta::today()->format('d M Y')}}
            </div>
        </div>
        <div class="top top-right">
            <div class="sidebar-widget text-right small-screen-center widget_nav_menu" id="nav_menu-5">
                <div class="menu-top-bar-menu-container">
                    @if(\Illuminate\Support\Facades\Auth::user())
                        <ul class="menu">
                            <li> <a href="{{route('adminIndex')}}">ناحیه کاربری</a> </li>
                            <li> <a href="{{route('logout')}}">خروج</a> </li>
                        </ul>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::guest())
                    <ul class="menu">
                        <li> <a href="{{ route('login') }}">ورود</a> </li>
                        <li> <a href="{{ route('register') }}">ثبت نام</a> </li>
                    </ul>
                    @endif
                </div>
            </div>
            <div class="sidebar-widget text-right small-screen-center widget_search">
                <form action="" method="get" name="searchform">
                    <div class="input-group">
                        <input class="form-control" id="s" name="s" placeholder="Search" type="text"> <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" id="searchsubmit" value="Search">
                                <i class="fa fa-search"></i>
                            </button>
                        </span> </div>
                </form>
            </div>
        </div>
    </div>
</div>
