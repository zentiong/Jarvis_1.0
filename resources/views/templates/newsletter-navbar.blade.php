<nav role="navigation" id="nav">
	<ul>
		<li><a href="{{ URL::to('/') }}"><span class="branding">Alfred 3.0</span></a>
		<li><a href="#calendar-container">Calendar</a></li>
		<li><a href="#services-container">Services</a></li>
		<li><a href="#policy-container">Policies</a></li>
		<li><a href="#engagements-container">Engagements</a></li>
		<li><a href="#hr-container">HR</a></li>
		<li><a href="{{ URL::to('dashboard')}}">Dashboard</a></li>
		<li><a href="{{ URL::to('employees') }}">VEmployees</a></li>
		<li><a href="{{ URL::to('employees/create') }}">CEmployees</a></li>
		<li class="login-button" id="login-button" onclick="hideShowLogin()">
			LOG IN
		</li>
	</ul>
</nav>
<div class="login-popup" id="login-popup">
        <form>
        	<label for="email">ZALORA Email Address</label>
            <input type="email" name="email" id="email" placeholder="name@ph.zalora.com">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <input type="checkbox" name="keep-logged-in" id="keep-logged-in"><label for="keep-logged-in">Keep me logged in</label>
            <input class="login-button" type="submit" style="display: table;" value="LOG IN">
        </form>
    </div>