<script type="text/javascript">
    $(document).ready(function() {
        // custom responsive navbutton
        let navButton = document.querySelector('nav button');

        navButton.addEventListener('click', function() {
            let expanded = this.getAttribute('aria-expanded') === 'true' || false;
            this.setAttribute('aria-expanded', !expanded);
            let menu = document.getElementById('nav-links').children;
            var i;
            for (i = 1; i < menu.length-1; i++) {
                menu[i].classList.toggle('open');
            }
            // menu.classList.toggle('open');
        });
    });
</script>

<nav role="navigation" id="navigation">
    <button id="navOpener" aria-expanded="false">Menu</button>
    <ul class="nav-links" id="nav-links">
            <li><a href="{{ URL::to('/') }}"><span class="branding">Alfred 3.0</span></a>
        @if (Route::has('login'))
            @auth
            <li><a id="levels" href="{{ URL::to('levels') }}">Dashboard</a></li>
            <li><a id="users" href="{{ URL::to('users') }}">Employees</a></li>
            <li><a id="skills"  href="{{ URL::to('skills') }}">Skills</a></li>
            <li><a id="positions"  href="{{ URL::to('positions') }}">Positions</a></li>
            <li><a id="quizzes"  href="{{ URL::to('quizzes') }}">Quizzes</a></li>
            <li><a id="assessments"  href="{{ URL::to('assessments') }}">Assessments</a></li>
            <li><a id="training-sessions"  href="{{ URL::to('trainings') }}">Trainings</a></li>
            <li class="login-button" id="login-button">
                <h6 class="current-username">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
                <a class="logout-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOG OUT</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                </form>
            </li>
        @else
            <li class="login-button" id="login-button" onclick="hideShowLogin()">
                LOG IN
            </li>
            @endauth
        @endif
    </ul>
    <!-- <ul class="mobile-menu" id="mobile-menu">
        <li><a href="{{ URL::to('/') }}"><span class="branding">Alfred 3.0</span></a>
        <button id="navOpener" aria-expanded="false">Menu</button>
        @auth
            <li class="login-button" id="login-button">
                <h6 class="current-username">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
                <a class="logout-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOG OUT</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                </form>
            </li>
        @endauth
    </ul> -->
</nav>