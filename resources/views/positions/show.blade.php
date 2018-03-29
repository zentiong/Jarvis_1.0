@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="row crud-page-top">
            <div>
                <h1 class="crud-page-title">{{ $position->name }} Position</h1>
                <h5>Current Employee List</h5>
            </div>
            <a href="{{ URL::to('positions') }}" class="btn cancel-btn">Back to All Positions</a>
        </section>
        <section class="container flex-column-center employees-positions">
            @foreach($users as $key=>$user)
                <?php 
                    $check = $user->profile_photo;
                    if($check!=null)
                    {
                        $pp = asset( 'images/profile_photos/'.$user->profile_photo);
                    } 
                    else 
                    {
                        $pp = asset( 'images/profile_photos/default.png');     
                    }
                ?>
                <div class="flex-row-center">
                    <div class="img-circle profile-picture" style="background-image: url('{{ $pp }}');" alt="Your profile picture"></div>
                    <div class="flex-column-center">
                        <div>
                            <strong>{{$user->first_name}} {{$user->last_name}}</strong> 
                        </div>
                        <div>
                            {{$user->department}} 
                        </div>
                    </div>
                    <div>
                        <a href="">LINK TO PROFILE</a>
                    </div>
                </div>
            @endforeach
        </section>
    </main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('positions');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>