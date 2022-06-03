<div id="{{env('APP_ENV') == 'development' ? 'dev' : 'prod'}}" class="container-fluid main-nav">
    @if (!Auth::guest())
    @else
    <nav class="nav blog-nav">
        <div id="left-side">
            <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-nav fa-home" aria-hidden="true"></i></a>
            <a class="nav-link" href="{{ route('results') }}"><b class="onglet">RESULTATS</b></a>
            <a class="nav-link" href="{{ route('emergen') }}"><b class="onglet">EMERGEN</b></a>
            <a class="nav-link" href="{{ route('import-files') }}"><b class="onglet">IMPORTER</b></a>
            <a class="nav-link" href="{{ route('export') }}"><b class="onglet">EXPORTER</b></a>
        </div>

        <div id="right-side">
            @if (Auth::check())
            <div class="dropdown">
                <i class="nav-link fa fa-nav fa-envelope"></i>
                <!-- <i class="nav-link fa fa-nav fa-envelope" :class="hasNotifs()" data-toggle="dropdown" v-on:click="markAsRead()"></i>
                <div class="dropdown-menu">
                    <notifications :notifications="notifications"></notifications>
                </div>
                <script src="{{ asset('js/notification.js') }}"></script> -->
            </div>
            @endif

            <a id="logout" class="nav-link" href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="LogOut">
                <i class="fa fa-nav fa-sign-out" aria-hidden="true"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </nav>
    @endif
</div>

<style>
    .onglet:hover, .fa:hover {
        color: white;
    }

    #left-side,#right-side{
        display:flex;
        align-items: inherit;
    }
    .onglet {
        color: #cdddeb;
    }
    .blog-nav{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .main-nav{
        position:fixed;
        z-index:10;
        background-color: #306bac;
    }
    .fa-nav{
        font-size: 1.5em;
        cursor: pointer;
        color: #cdddeb;
    }
    .hasNotif::after{
        content : " !";
        color: red;
        font-weight: bold;
    }
    #dev {
        background-color: green;
    }
</style>