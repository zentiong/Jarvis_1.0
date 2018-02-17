<!-- @extends('templates.dashboard-master') -->

@section('body')
    <main>
        <section class="container-fluid">
            <h1>All Employees</h1>
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

                            <!-- delete the employee (uses the destroy method DESTROY /users/{id} -->
                            <!-- we will add this later since its a little more complicated than the other two buttons -->
                                {{ Form::open(array('url' => 'users/' . $value->id)) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <div>
                                    {{ Form::submit('Delete', array('class' => 'btn delete-btn')) }}
                                </div>
                                
                             {{ Form::close() }}
                            <!-- show the employee (uses the show method found at GET /users/{id} -->
                            <a class="btn show-btn" href="{{ URL::to('users/' . $value->id) }}">
                                Show
                            </a>

                            <!-- edit this employee (uses the edit method found at GET /users/{id}/edit -->
                            <a class="btn edit-btn" href="{{ URL::to('users/' . $value->id . '/edit') }}">
                                Edit
                            </a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection
