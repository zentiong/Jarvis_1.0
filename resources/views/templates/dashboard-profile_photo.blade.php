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

<div class="inner">
    <a href="edit_dp" data-toggle="tooltip" data-placement="bottom" title="Click to edit profile picture" data-animation="true">
        <div class="img-circle profile-picture" style="background-image: url('{{ $cup }}')" alt="Your profile picture">
        </div>
    </a>
    <div class="user-details">
         @auth
        <h1 class="username-title">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
        <h6>{{ Auth::user()->position }}</h6>
        <h6>{{ Auth::user()->department }}</h6>
        <br>
        <h6>{{ Auth::user()->email }}</h6>
        @endauth
    </div>
</div>