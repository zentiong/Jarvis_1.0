<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jarvis - ENTREGO - Dashboard</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
    <link rel="mask-icon" href="{{ asset('favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" as="style" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" as="style" type="text/css" href="{{ asset('css/app.css') }}">
    <noscript>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    </noscript>
    
    <link rel="stylesheet" as="style" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <noscript>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </noscript>

    <!-- Load jQuery on demand per page. -->
    
</head>

<body class="dashboard">
@extends('templates.dashboard-navbar')

@yield('body')

@extends('templates.dashboard-footer')

</body> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>


<script type="text/javascript">
       
    if (typeof jQuery == 'undefined') {
        console.log('jQuery is not defined! you poor thing')
    }
    else {
        console.log('jQuery is defined!');
    }

    // prevents multiple form submissions
    $("form").on('submit', function() {
        $('.btn.create-btn, button.delete-btn, .btn.sign-up-btn, .btn.take-quiz-btn').attr('disabled','true');
    });

    $(document).ready(function() {
        $('.btn.toggle-card').click(function() {
            $(this).next().toggle(200);
        });
    });

</script>
</html>