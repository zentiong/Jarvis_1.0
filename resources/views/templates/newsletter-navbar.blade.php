<nav role="navigation">
	<ul>
		@if (Route::has('login'))
		<!-- LOGGED IN STATE -->
		<li><a href="{{ URL::to('/') }}"><span class="branding">Alfred 3.0</span></a>
			@auth
				<li><a id="levels" href="{{ URL::to('levels') }}">Dashboard</a></li>
				<li><a id="users" href="{{ URL::to('users') }}">Employees</a></li>
				<li><a id="skills"  href="{{ URL::to('skills') }}">Skills</a></li>
				<li><a id="positions"  href="{{ URL::to('positions') }}">Positions</a></li>
				<li><a id="quizzes"  href="{{ URL::to('quizzes') }}">Quizzes</a></li>
				<li><a id="training-sessions"  href="{{ URL::to('trainings') }}">Training Sessions</a></li>
				<li class="login-button" id="login-button">
					@auth
                    <h6 class="current-username">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
                    @endauth
					<a class="logout-link clicked" href="{{ route('logout') }}" onclick="event.preventDefault();
		                                                     document.getElementById('logout-form').submit();">
		                                                     LOG OUT</a>

		            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                {{ csrf_field() }}
		            </form>
		        </li>
			@else
				<!-- LOGGED OUT STATE -->
				<li class="login-button-yellow	" id="login-button" onclick="hideShowLogin()">
					LOG IN
				</li>
			@endauth
		@endif
	</ul>
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