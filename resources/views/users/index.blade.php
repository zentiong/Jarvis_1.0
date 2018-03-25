@extends('templates.dashboard-master')

@section('body')
    <main class="container-fluid">
        <section class="container-fluid">
            <div class="row crud-page-top">
                <h1 class="crud-page-title">All Employees</h1>
                <button class="btn crud-main-cta" type="button" data-toggle="modal" data-target="#createModal">&#43; Add Employee</button>
                <input type="text" id="search_input" onkeyup="filter_table()" placeholder="Search for employees" title="Type in a name">
            </div>
            
            <script>
            function filter_table() 
            {
              var input, filter, table, tr, td, i;
              input = document.getElementById("search_input");
              filter = input.value.toUpperCase();
              table = document.getElementById("target_table");
              tr = table.getElementsByTagName("tr");
              for (i = 0; i < tr.length; i++) 
              {
                td = tr[i].getElementsByTagName("td")[1];
                td1 = tr[i].getElementsByTagName("td")[2];
                td2 = tr[i].getElementsByTagName("td")[3];
                td3 = tr[i].getElementsByTagName("td")[4];
                td4 = tr[i].getElementsByTagName("td")[5];
                td5 = tr[i].getElementsByTagName("td")[6];
                td6 = tr[i].getElementsByTagName("td")[8];
                td7 = tr[i].getElementsByTagName("td")[9];
                if (td) 
                {
                  if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1 || td4.innerHTML.toUpperCase().indexOf(filter) > -1 || td5.innerHTML.toUpperCase().indexOf(filter) > -1 || td6.innerHTML.toUpperCase().indexOf(filter) > -1 || td7.innerHTML.toUpperCase().indexOf(filter) > -1) 
                  {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";
                  }
                }       
              }
            }
            </script>

            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}
            
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info">
                    {{ Session::get('message') }}
                    {{ Html::ul($errors->all()) }}
                </div>
            @endif

            <table id="target_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>User ID</td>
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td>Email</td>
                        <td>Hiring Date</td>
                        <td>Birth Date</td>
                        <td>Department</td>
                        <td>Supervisor ID</td>
                        <td>Position</td>
                        <td>Manager?</td>
                        <td class="no-stretch">Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->first_name }}</td>
                        <td>{{ $value->last_name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ date('F d, Y', strtotime($value->hiring_date)) }}</td>
                        <td>{{ date('F d, Y', strtotime($value->birth_date)) }}</td>
                        <td>{{ $value->department }}</td>
                        <td>{{ $value->supervisor_id }}</td>
                        <td>{{ $value->position }}</td>

                        @if($value->manager_check==true)
                            <td>Yes</td>
                        @else
                            <td>No</td>
                        @endif

                        <!-- we will also add show, edit, and delete buttons -->
                        <td class="table-actions">
                            <!-- show the employee (uses the show method found at GET /users/{id} -->
                            <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View employee" href="{{ URL::to('users/' . $value->id) }}">
                                <i class="fa fa-user fa-lg"></i>
                            </a>

                            <!-- edit this employee (uses the edit method found at GET /users/{id}/edit -->
                            <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit employee" href="{{ URL::to('users/' . $value->id . '/edit') }}">
                                <i class="fa fa-pencil fa-lg"></i>
                            </a>
                            <!-- delete the employee (uses the destroy method DESTROY /users/{id} -->
                            <!-- we will add this later since its a little more complicated than the other two buttons -->
                                {{ Form::open(array('url' => 'users/' . $value->id)) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <div data-toggle="tooltip" data-placement="bottom" title="Remove employee" >
                                    {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                                </div>
                                
                             {{ Form::close() }}
                            
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body create-page">
                {{ Form::open(array('url' => 'users','files'=>true)) }}
                        <div class="form-group">
                            {{Form::label('user_photo', 'User Photo',['class' => 'control-label'])}}
                            <div class="form-control user-photo">{{Form::file('user_photo')}}</div>
                        </div>

                    
                        <div class="row">
                            <div class="col-md-6">
                                <!-- FIRST NAME -->
                                <div class="form-group">
                                    {{ Form::label('first_name', 'First Name') }}
                                    {{ Form::text('first_name', Request::old('first_name'), array('class' => 'form-control', 'autofocus', 'required')) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- LAST NAME -->
                                 <div class="form-group">
                                    {{ Form::label('last_name', 'Last Name') }}
                                    {{ Form::text('last_name', Request::old('last_name'), array('class' => 'form-control', 'required')) }}
                                </div>
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', Request::old('email'), array('class' => 'form-control', 'required')) }}
                        </div>
                        
                        <!-- PASSWORD -->
                        <div class="form-group">
                            {{ Form::label('password', 'Password') }}
                            {{ Form::password('password', Request::old('password'), array('class' => 'form-control', 'required')) }}
                        </div>

                        <!-- Hiring Date -->
                        <div class="form-group">
                            {{ Form::label('hiring_date', 'Hiring Date') }}
                            {{ Form::date('hiring_date', Request::old('hiring_date'), array('class' => 'form-control', 'required')) }}
                        </div>

                        <!-- Birth Date -->
                        <div class="form-group">
                            {{ Form::label('birth_date', 'Birth Date') }}
                            {{ Form::date('birth_date', Request::old('birth_date'), array('class' => 'form-control', 'required')) }}
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Department -->
                                <div class="form-group">
                                    {{ Form::label('department', 'Department') }}
                                    {{ Form::select('department', array('Finance' => 'Finance', 'Human Resources' => 'Human Resources', 'Customer Service' => 'Customer Service'), Request::old('department'), array('class' => 'form-control')) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Position -->
                                {{ Form::label('position', 'Position') }}
                                <select id="position" class="form-control" name="position">
                                    @foreach($positions as $key => $value)
                                    <option value="<?php echo $value->name ?>">
                                        {{$value->name}} 
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Supervisor -->
                        <div class="form-group">
                            {{ Form::label('supervisor_id', 'Supervisor') }}
                            <select id="supervisor_id" class="form-control" name="supervisor_id">
                            @foreach($users as $key => $value)
                            <option value="<?php echo $value->id ?>">
                                {{$value->first_name}} {{$value->last_name}}
                            </option>
                            @endforeach
                            </select>
                        </div>

                        <!-- Manager? -->
                        <div class="form-group">
                            {{ Form::label('manager_check', 'Manager?') }}
                            {{ Form::checkbox('manager_check', 1, Request::old('manager_check')) }}
                        </div>
           
              </div>
              <div class="modal-footer create-bottom-wrapper">
                <a href="{{ URL::to('users') }}" class="btn cancel-btn" data-dismiss="modal">Cancel</a>
                {{ Form::submit('Create employee', array('class' => 'btn btn-primary create-btn text-center')) }}
              </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>

    </main>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    console.log('jquery.min.js');
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('users');
        a.classList.toggle("active");
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
