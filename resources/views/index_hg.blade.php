@extends('templates.newsletter-master') 

@section('body')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<?php 
$current_user = Auth::user();
$current_id = Auth::user()->id;
$trainings = $current_user->training_session_id
?>

<script type="text/javascript">
    
    function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    }

</script>

<p>HR+MANAGER LANDING</p>
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'skills')">My Skills</button>
  <button class="tablinks" onclick="openCity(event, 'employees')">Employees Under Me</button>
  <button class="tablinks" onclick="openCity(event, 'trainings')">Trainings</button>
</div>

<div id="skills" class="tabcontent">
  <h5>Skills graph here</h5>
</div>

<div id="employees" class="tabcontent">
  <body class="dashboard">
    <main>
        <section class="container-fluid">
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td>Email</td>
                        <td>Hiring Date</td>
                        <td>Birth Date</td>
                        <td>Department</td>
                        <td>Supervisor ID</td>
                        <td>Position</td>
                        <td>Manager?</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $value)
                    @if($value->supervisor_id==$current_id)
                        <tr>
                            <td>{{ $value->first_name }}</td>
                            <td>{{ $value->last_name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->hiring_date }}</td>
                            <td>{{ $value->birth_date }}</td>
                            <td>{{ $value->department }}</td>
                            <td>{{ $value->supervisor_id }}</td>
                            <td>{{ $value->position }}</td>

                            @if ($value->manager_check==1)
                            <td>Yes</td>
                            @else
                            <td>No</td>
                            @endif

                            <!-- we will also add show, edit, and delete buttons -->
                            <td class="table-actions">
                                <a class="btn show-btn" href="{{ URL::to('users/' . $value->id) }}">
                                    <i class="fa fa-user"></i>View Profile 
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
</body>
</div>

<div id="trainings" class="tabcontent">
  <body class="dashboard">
    <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Date</td>
            <td>Description</td>
            <td>Speaker</td>
            <td>Venue</td>
        </tr>
    </thead>
    <tbody>
    @foreach($training_sessions as $key => $value)
        <tr>
            <td>{{ $value->date }}</td>
            <td>{{ $value->description }}</td>
            <td>{{ $value->speaker }}</td>
            <td>{{ $value->venue }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the employee (uses the destroy method DESTROY /employees/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                    {{ Form::open(array('url' => 'users/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Employee', array('class' => 'btn btn-warning')) }}
                 {{ Form::close() }}
                <!-- show the employee (uses the show method found at GET /employees/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('users/' . $value->id) }}">Show this Employee</a>

                <!-- edit this employee (uses the edit method found at GET /employees/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('users/' . $value->id . '/edit') }}">Edit this Employee</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>  
<a href="trainings/create">Add New Training</a>
  </body>
</div>
@endsection