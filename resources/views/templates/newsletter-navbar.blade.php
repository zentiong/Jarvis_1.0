<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<nav role="navigation">
    <a class="home-link" href="{{ URL::to('/') }}">
        <span class="branding">Alfred 3.0</span>
    </a>
	@if (Route::has('login'))
    <!-- LOGGED IN STATE -->
    @auth
    <ul class="nav-links" id="nav-links">	
		<li><a id="levels" href="{{ URL::to('levels') }}">Dashboard</a></li>
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
            <a class="logout-link clicked" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOG OUT</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    	
	</div>
	@else
	<!-- LOGGED OUT STATE -->
	<div class="login-button-yellow" id="login-button-yellow" onclick="hideShowLogin()">
		LOG IN
	</div>
	@endauth
	@endif
</nav>


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
                <hr>
                <small style="color: black;">Sign in another way</small>
	            <a href="{{URL::to('auth/google')}}"><img src="{{ asset('images/btn_google_signin_light_normal_web@2x.png') }}" alt="Sign In with Google" style="width: 180px;"></a>
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