@extends('templates.dashboard-master') 
<script src="{{ URL::asset('js/dashboard.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>

<script type="text/javascript">
    // enables dynamic navbar
    // enables tooltips
    $(document).ready(function() {
        var a = document.getElementById('levels');
        a.classList.toggle("active");
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

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
        
        <section class="row personal-details hr-pastel">

        @include('templates.dashboard-profile_photo', ['current_user' => $current_user, 'current_id' => $current_id])

        <section class="container dashboard-container">

        <div class="row dashboard-tab-container">
          <button class="btn tablinks" onclick="openTab(event, 'personal')">Personal</button>
          <button class="btn tablinks" onclick="openTab(event, 'employees')">Department-Wide</button>
          <button class="btn tablinks" onclick="openTab(event, 'trainings')">Company-Wide</button>
        </div>


        <div class="row dashboard-body tabcontent" id="personal">
        @include('templates.dashboard-skills', ['user_skills' => $user_skills])
            
        @include('templates.dashboard-trainings')
        </div>

            <!-- EMployees CONTENT CONTAINER -->
                <div class="row dashboard-body tabcontent" id="employees">
                    <div class="col-md-12">
                        <h5 class="dashboard-header">Department overview</h5>
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
                                                <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View employee" href="{{ URL::to('users/' . $value->id) }}">
                                                    <i class="fa fa-user fa-lg"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                 <!-- TRAININGS CONTENT CONTAINER -->
            <div class="row dashboard-body tabcontent" id="trainings">
                <div class="col-md-7">
                    <h5 class="dashboard-header">Overall skills statistics</h5>
                    <div class="dashboard-content">
                    </div>
                </div>
                <div class="col-md-5">
                    <h5 class="dashboard-header">Overall training statistics</h5>
                    <div class="dashboard-content">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td>Date</td>
                                    <td>Title</td>
                                    <td>Speaker</td>
                                    <td>Venue</td>
                                    <td class="no-stretch">Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($trainings as $key => $value)
                                <tr>
                                    <td>{{ $value->date }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->speaker }}</td>
                                    <td>{{ $value->venue }}</td>

                                    <!-- we will also add show, edit, and delete buttons -->
                                    <td class="table-actions no-stretch">

                                        <!-- show the employee (uses the show method found at GET /employees/{id} -->
                                        <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View employee" href="{{ URL::to('users/' . $value->id) }}">
                                            <i class="fa fa-user fa-lg"></i>
                                        </a>

                                        <!-- edit this employee (uses the edit method found at GET /employees/{id}/edit -->
                                        <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit employee" href="{{ URL::to('users/' . $value->id . '/edit') }}">
                                             <i class="fa fa-pencil fa-lg"></i>
                                        </a>

                                        <!-- delete the employee (uses the destroy method DESTROY /employees/{id} -->
                                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                                            {{ Form::open(array('url' => 'users/' . $value->id, 'class' => 'pull-right')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            <div data-toggle="tooltip" data-placement="bottom" title="Delete employee" data-animation="true">
                                                {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                                            </div>

                                         {{ Form::close() }}
                                        

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>  
                        <a class="crud-main-cta" href="trainings/create">&#43; Add Training</a> 
                    </div>
                </div>
            </div>

        </section>

        </section>

    </main>
@endsection
