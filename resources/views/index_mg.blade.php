@extends('templates.dashboard-master') 

<script src="{{ URL::asset('js/dashboard.js') }}"></script>

@section('body')
    <main class="container-fluid">
        <section class="container-fluid">
        
             <?php 
                $current_user = Auth::user();
                $current_id = Auth::user()->id;
                
            ?>
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            
            <section class="row personal-details mg-pastel">

            @include('templates.dashboard-profile_photo', ['current_user' => $current_user, 'current_id' => $current_id])

            <section class="container dashboard-container">
                <!-- TAB CONTAINER -->
                <div class="row dashboard-tab-container">
                    <button class="btn tablinks" onclick="openTab(event, 'personal')">Personal</button>
                    <button class="btn tablinks"  onclick="openTab(event, 'non-personal')">Department-wide</button>
                </div>
                
                <div class="row dashboard-body tabcontent" id="personal">
                    @include('templates.dashboard-skills')
                    @include('templates.dashboard-trainings')

                </div>
                
                <!-- NON-PERSONAL CONTENT CONTAINER -->
                <div class="row dashboard-body tabcontent" id="non-personal">
                    <div class="col-md-12">
                        <h5 class="dashboard-header"><i class="fa fa-users"></i>Department overview</h5>
                        <div class="dashboard-content">

                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>First Name</td>
                                        <td>Last Name</td>
                                        <td>Email</td>
                                        <td>Hiring Date</td>
                                        <td>Birth Date</td>
                                        <td>Department</td>
                                        <td>Supervisor</td>
                                        <td>Position</td>
                                        <td>Manager?</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                <?php

                                    $list = array();

                                    $output = subordinates($current_user);

                                    while(!empty($output)) {

                                        $buffer = $output;
                                        $output = array();

                                        foreach ($buffer as $key => $input) {
                                            if(!in_array($input, $list))
                                            {
                                                array_push($list, $input);
                                                $output = subordinates($input);
                                            }
                                        }
                                    }



                                    /*--------*/

                                    function subordinates ($user) {
                                        $output = $user->subordinates()->get();

                                        return $output;
                                    } 

                                ?>
                                @foreach($list as $key => $user)
                                    <tr>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->hiring_date }}</td>
                                        <td>{{ $user->birth_date }}</td>
                                        <td>{{ $user->department }}</td>
                                        @foreach($users_two as $key => $supervisor)
                                            @if($user->supervisor_id == $supervisor->id)
                                                 <td>{{ $supervisor->first_name }} {{ $supervisor->last_name }}</td>
                                            @endif
                                        @endforeach
                                        <td>{{ $user->position }}</td>
                                        @if ($user->manager_check==1)
                                        <td>Yes</td>
                                        @else
                                        <td>No</td>
                                        @endif
                                        <!-- we will also add show, edit, and delete buttons -->
                                        <td class="table-actions">
                                            <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View employee" href="{{ URL::to('users/' . $user->id) }}">
                                                <i class="fa fa-user fa-lg"></i>
                                            </a>
                                        </td>
                                        </tr>                
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
        
       </section>

    </main>
    
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ URL::asset('js/dashboard.js') }}"></script>
<script type="text/javascript">
    // enables dynamic navbar
    $(document).ready(function() {
        var a = document.getElementById('levels');
        a.classList.toggle("active");
    });
     // enables Bootstrap tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>