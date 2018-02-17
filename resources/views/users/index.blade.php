<!-- @extends('templates.dashboard-master') -->

<script type="text/javascript">
    // enables Bootstrap tooltips
    // $(function () {
    //   $('[data-toggle="tooltip"]').tooltip();
    // })
    $(document).ready(function() {
        $("body").tooltip({ selector: '[data-toggle=tooltip]' });
    });
</script>

@section('body')
    <main class="container-fluid">
        <section class="container-fluid">
            <div class="row crud-page-top">
                <h1 class="crud-page-title">All Employees</h1>
                <a href="{{ URL::to('users/create') }}" class="btn crud-main-cta">&#43; Add Employee</a>
            </div>
            
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <table class="table table-striped table-bordered">
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
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->first_name }}</td>
                        <td>{{ $value->last_name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->hiring_date }}</td>
                        <td>{{ $value->birth_date }}</td>
                        <td>{{ $value->department }}</td>
                        <td>{{ $value->supervisor_id }}</td>
                        <td>{{ $value->position }}</td>
                        <td>{{ $value->manager_check }}</td>

                        <!-- we will also add show, edit, and delete buttons -->
                        <td class="table-actions">
                            <!-- show the employee (uses the show method found at GET /users/{id} -->
                            <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="Show" data-animation="true" href="{{ URL::to('users/' . $value->id) }}">
                                <i class="fa fa-user fa-lg"></i>
                            </a>

                            <!-- edit this employee (uses the edit method found at GET /users/{id}/edit -->
                            <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit" data-animation="true" href="{{ URL::to('users/' . $value->id . '/edit') }}">
                                <i class="fa fa-pencil fa-lg"></i>
                            </a>
                            <!-- delete the employee (uses the destroy method DESTROY /users/{id} -->
                            <!-- we will add this later since its a little more complicated than the other two buttons -->
                                {{ Form::open(array('url' => 'users/' . $value->id)) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <!-- <div>
                                    <i class="fa fa-trash-o"></i>
                                    {{ Form::submit('Delete', array('class' => 'btn delete-btn')) }}
                                </div> -->
                                <div data-toggle="tooltip" data-placement="bottom" title="Delete" data-animation="true">
                                    {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                                </div>
                                
                             {{ Form::close() }}
                            
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection
