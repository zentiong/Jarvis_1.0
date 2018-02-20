<!DOCTYPE html>
<html lang="en">
<head>
    <title>ZALORA Skills Information System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
</head>


<body class="newsletter">
@extends('templates.newsletter-navbar')

@yield('body')

@extends('templates.newsletter-footer')

</body> 
</html>

<!-- <nav role="navigation">
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
</nav> -->