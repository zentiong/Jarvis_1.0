@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="row crud-page-top">
            <div>
                <h1 class="crud-page-title">Information about position</h1>
                <h5>Showing: {{ $position->name }}</h5>
            </div>
            <a href="{{ URL::to('positions') }}" class="btn cancel-btn">Back to All Positions</a>
        </section>
        <section>
             <div class="jumbotron text-center">
                <p>
                    <strong>Position name:</strong> {{ $position->name }}<br>
                    <strong>Current Employees:</strong><br>
                    <table>
                    <thead>
                        <tr>Photo</tr>
                        <tr>Name</tr>
                        <tr>Department</tr>
                        
                    </thead>
                    <tbody>
                        @foreach($users as $key=>$user)
                            <tr>
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

                            <div class="img-circle profile-picture" style="background-image: url('{{ $pp }}')" alt="Your profile picture"></div>

                            </tr>
                            <tr>{{$user->first_name}} {{$user->last_name}} </tr>
                            <tr>{{$user->department}}  </tr>
                        @endforeach
                    </tbody>
                    
                    </table>
                </p>
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