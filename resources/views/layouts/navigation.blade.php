
<nav class="navbar transition-all ease-in-out" role="navigation" aria-label="main navigation" x-data="{navbarOpen: false}">
    <div class="navbar-brand pt-4">
      <a class="navbar-item" href="/">
        <img src="{{Storage::url('logo.png')}}" width="112" height="112">
      </a>

      <a role="button" class="navbar-burger" @click="navbarOpen = true" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div class="navbar-menu transition duration-500 ease-in-out " :class="{'is-active': navbarOpen}" @click.away="navbarOpen = false">


        @if (Auth::check())
        <div class="navbar-start">
          <a class="navbar-item is-tab {{request()->is(Auth::user()->name) ? 'is-active font-bold ' : ''}}" href="{{Auth::user()->name}}">
            My Page
          </a>

          <a class="navbar-item is-tab {{request()->is('page') ? 'is-active font-bold ' : ''}}" href="page">
            Page Editor
          </a>

            <a class="navbar-item is-tab {{request()->is('account') ? 'is-active font-bold ' : ''}}" href="account">
                Account
            </a>
            <a class="navbar-item is-tab {{request()->is('card-maker') ? 'is-active font-bold ' : ''}}" href="card-maker">
                Card Maker
            </a>
        </div>

      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <a class="button is-light"
             href="{{route('logout')}}"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Log out
            </a>
          </div>
        </div>
      </div>


    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
        @endif

      @if (!Auth::check())
      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <a class="button is-primary" href="/register">
              <strong>Sign up</strong>
            </a>
            <a class="button is-light" href="/login">
              Log in
            </a>
          </div>
        </div>
      </div>
      @endif

    </div>



     </div>{{--navbar-menu ending  --}}
  </nav>
