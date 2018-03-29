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
        <section>
             <div class="text-center flex-column-center">
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
                    <div>
                        <div class="img-circle profile-picture" style="background-image: url('{{ $pp }}')" alt="Your profile picture"></div>
                    </div>
                    <div>
                        {{$user->first_name}} {{$user->last_name}} 
                        {{$user->department}} 
                    </div>
                    
                @endforeach
            </div>
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