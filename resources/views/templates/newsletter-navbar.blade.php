<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<nav role="navigation">
	<button class="btn nav-opener" role="button" id="navOpener" aria-expanded="false" onclick="showMenu()">
        <div class="hamburger-line"></div>
        <div class="hamburger-line"></div>
        <div class="hamburger-line"></div>
    </button>
    <a class="home-link" href="{{ URL::to('/') }}">
        <span class="branding">Alfred 3.0</span>
    </a>
    @if (Route::has('login'))
	<ul class="nav-links" id="nav-links">
		<!-- LOGGED IN STATE -->
			@auth
				<li><a id="levels" href="{{ URL::to('levels') }}">Dashboard</a></li>
				@if ( Auth::user()->department == 'Human Resources')
				<li><a id="users" href="{{ URL::to('users') }}">Employees</a></li>
				<li><a id="skills"  href="{{ URL::to('skills') }}">Skills</a></li>
				<li><a id="positions"  href="{{ URL::to('positions') }}">Positions</a></li>
				<li><a id="quizzes"  href="{{ URL::to('quizzes') }}">Quizzes</a></li>
				<li><a id="assessments"  href="{{ URL::to('assessments') }}">Assessments</a></li>
				<li><a id="training-sessions"  href="{{ URL::to('trainings') }}">Trainings</a></li>
				@endif
	</ul>
	<div class="login-button" id="login-button">
		@auth
		<img class="img-circle small-profile-picture" src="{{ asset('images/hr-corp/DL.png') }}" alt="Your profile picture">
        <h6 class="current-username">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
        @endauth
		<a class="logout-link clicked" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
		 LOG OUT</a>
		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			{{ csrf_field() }}
		</form>
	</div>
	@else
	<!-- LOGGED OUT STATE -->
	<div class="login-button-yellow" id="login-button" onclick="hideShowLogin()">
		LOG IN
	</div>
	@endauth
	@endif
</nav>
<!--remove after login 
-->
<div class="login-popup" id="login-popup">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	        	<label for="email">ZALORA Email Address</label>
	            <input type="email" name="email" id="email" placeholder="name@ph.zalora.com" value="{{ old('email') }}" required>
	            
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	            <label for="password">Password</label>
	            <input type="password" name="password" id="password" required>
	            @if ($errors->has('password'))
                    <div class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                        <script type="text/javascript">
                        	alert("Wrong credentials. Please try again.");
                        </script>
                   </div>
                @endif
            </div>
	            <input type="checkbox" name="keep-logged-in" id="keep-logged-in" {{ old('remember') ? 'checked' : '' }}>
	            <label for="keep-logged-in">Keep me logged in</label>
	            <input class="login-button-yellow" type="submit" style="display: table;" value="LOG IN">
        </form>
        
    </div>
    @if ($errors->has('email'))
    	<div class="login-error-wrapper" id="login-error-wrapper" onclick="closeLoginError()">
    		<div class="help-block">
	         	<i class="fa fa-exclamation-triangle fa-lg"></i>
	         	<strong>{{ $errors->first('email') }}<br>Please try again.</strong>
	     	</div>
	     	<button class="btn">
	     		CLOSE
	     	</button>
    	</div>
 @endif

 <script type="text/javascript">
	window.onload = function() {
		var navButton = document.querySelector('.nav-opener');
		console.log(`navButton: ${navButton}`);
    	let expanded = navButton.getAttribute('aria-expanded') === 'true' || false;

       	navButton.setAttribute('aria-expanded', !expanded);
       	let menu = document.getElementById('nav-links').children;
       	var i;
       	for (i = 0; i < menu.length; i++) {
           	menu[i].classList.toggle('open');
       	}
	}    
	// $(document).ready(function() {
	// 	alert("hello");
	// });
</script>