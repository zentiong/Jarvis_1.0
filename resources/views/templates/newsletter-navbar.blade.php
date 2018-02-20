<nav role="navigation">
	<ul>
		@if (Route::has('login'))
		<li><a href="{{ URL::to('/') }}"><span class="branding">Alfred 3.0</span></a>
			@auth
				<li><a href="{{ URL::to('users') }}">VEmployees</a></li>
				<li><a href="{{ URL::to('users/create') }}">CEmployees</a></li>
				<li><a href="{{ URL::to('quizzes') }}">VQuiz</a></li>
				<li><a href="{{ URL::to('quizzes/create') }}">CQuiz</a></li>
				<li class="login-button" id="login-button">
					<a class="logout-link" href="{{ route('logout') }}" onclick="event.preventDefault();
		                                                     document.getElementById('logout-form').submit();">
		                                                     LOG OUT</a>

		            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                {{ csrf_field() }}
		            </form>
		        </li>
			@else
				<li><a href="#">Calendar</a></li>
				<li><a href="#">Services</a></li>
				<li><a href="#">Policies</a></li>
				<li><a href="#">Engagements</a></li>
				<li><a href="#">HR</a></li>
				<li class="login-button" id="login-button" onclick="hideShowLogin()">
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
	            @if ($errors->has('email'))
                    <div class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                        <script type="text/javascript">
                        	alert("Wrong credentials. Please try again.");
                        </script>
                    </div>
                @endif
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
	            <input class="login-button" type="submit" style="display: table;" value="LOG IN">
        </form>
    </div>