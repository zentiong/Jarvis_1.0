@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

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

 <section class="row personal-details hr-pastel">
<div class="inner">
    <div class="img-circle profile-picture" style="background-image: url('{{ $cup }}')" alt="Your profile picture">
    </div>
    
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

</section>