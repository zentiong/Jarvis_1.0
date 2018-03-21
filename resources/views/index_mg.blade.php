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

            </section>
        
       </section>

    </main>
    
@endsection

