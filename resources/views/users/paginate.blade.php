@foreach($users as $key => $value)
    <tr>
        <td>{{ $value->first_name }}</td>
        <td>{{ $value->last_name }}</td>
        <td>{{ $value->email }}</td>
        <td>{{ date('F d, Y', strtotime($value->hiring_date)) }}</td>
        <td>{{ date('F d, Y', strtotime($value->birth_date)) }}</td>
        <td>{{ $value->department }}</td>
        @foreach($users_two as $key => $supervisor)
            @if($value->supervisor_id == $supervisor->id)
                 <td>{{ $supervisor->first_name }} {{ $supervisor->last_name }}</td>
            @endif
        @endforeach
       
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

