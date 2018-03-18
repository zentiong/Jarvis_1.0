@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<?php 


if(file_exists('images/profile_photos/'.Auth::user()->profile_photo))
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
    <img class="img-circle profile-picture" src="{{ $cup }}" alt="Not Available">
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