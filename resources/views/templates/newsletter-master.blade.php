<!DOCTYPE html>
<html lang="en">
<head>
    <title>ZALORA Skills Information System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
</head>

<script type="text/javascript">
    function hideShowLogin() {
        var x = document.getElementById('login-popup');
        var y = document.getElementById('login-button');
        if (x.style.display === "block") {
            x.style.display = "none";
            y.classList.remove('clicked');
        }
        else {
            x.style.display = "block";
            y.classList.add('clicked');
        }
    }
</script>


<body class="newsletter">
@extends('templates.newsletter-navbar')

@yield('body')

@extends('templates.newsletter-footer')

</body> 
</html>