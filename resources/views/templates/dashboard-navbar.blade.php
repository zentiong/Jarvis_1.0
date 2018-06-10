<script type="text/javascript">
    $(document).ready(function() {
        // custom responsive navbutton
        let navButton = document.querySelector('nav button');

        navButton.addEventListener('click', function() {
            let expanded = this.getAttribute('aria-expanded') === 'true' || false;
            this.setAttribute('aria-expanded', !expanded);
            let menu = document.getElementById('nav-links').children;
            var i;
            for (i = 0; i < menu.length; i++) {
                menu[i].classList.toggle('open');
            }
            // menu.classList.toggle('open');
        });
    });
</script>

<nav role="navigation" id="navigation">
    <button class="btn nav-opener" role="button" id="navOpener" aria-expanded="false">
        <div class="hamburger-line"></div>
        <div class="hamburger-line"></div>
        <div class="hamburger-line"></div>
    </button>
    <a class="home-link" href="{{ URL::to('/') }}">
        <span class="branding">Jarvis</span>
    </a>
    <ul class="nav-links" id="nav-links">  
        @if (Route::has('login'))
            @auth
            <li><a id="levels" href="{{ URL::to('levels') }}">Dashboard</a></li>
            <!-- <li><a id="quizzes-history" href="{{ URL::to('history') }}">Quiz History</a></li> -->
            @if ( Auth::user()->department == 'Human Resources')
            <li><a id="users" href="{{ URL::to('users') }}">Employees</a></li>
            <li><a id="skills"  href="{{ URL::to('skills') }}">Skills</a></li>
            <li><a id="positions"  href="{{ URL::to('positions') }}">Positions</a></li>
            <li><a id="quizzes"  href="{{ URL::to('quizzes') }}">Quizzes</a></li>
            <li><a id="assessments"  href="{{ URL::to('assessments') }}">Assessments</a></li>
            <li><a id="training-sessions"  href="{{ URL::to('trainings') }}">Trainings</a></li>
            <li><a id="events"  href="{{ URL::to('events') }}">Events</a></li>
            <li><a id="services" href="{{ URL::to('services') }}">Services</a></li>
            <li><a id="policies" href="{{ URL::to('policies') }}">Policies</a></li>
            <li><a id="HR" href="{{ URL::to('hrs') }}">HR</a></li>
            @endif

            <!-- @if ( Auth::user()->manager_check == 1)
            <li><a id="users" href="{{ URL::to('make_assessments') }}">Employee Assessment</a></li>
            @endif -->

    </ul>

    <?php 

        $check = Auth::user()->profile_photo;
    
        if($check!=null)
        {
            $cup = asset( 'images/profile_photos/'.Auth::user()->profile_photo);
        }
        else 
        {
            $cup = asset( 'images/profile_photos/default.png');
        }
            
    ?>

    <div class="login-button" id="login-button">
        <a href="edit_dp">
            <div class="img-circle small-profile-picture" style="background-image: url('{{ $cup }}')" alt="Your profile picture">
            </div>
        </a>
        <div>
            <h6 class="current-username">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
            <a class="logout-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOG OUT</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
            </form>
        </div>
    </div>
    @endauth
    @endif
</nav>