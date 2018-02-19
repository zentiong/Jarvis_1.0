@extends('templates.dashboard-master')

@section('body')
<<<<<<< HEAD
<h1>Current Positions</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Positions</td>
            <td>Operations</td>
        </tr>
    </thead>
    <tbody>
    @foreach($positions as $key => $value)
        <tr>
            <td>{{ $value->name }}</td>
            
            <td>

                    {{ Form::open(array('url' => 'positions/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                 {{ Form::close() }}
                <!-- show the employee (uses the show method found at GET /employees/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('positions/' . $value->id) }}">Show</a>

                <!-- edit this employee (uses the edit method found at GET /employees/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('positions/' . $value->id . '/edit') }}">Edit</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
=======

    <main class="container-fluid">
        <section class="container-fluid">
            <div class="row crud-page-top">
                <h1 class="crud-page-title">Current Positions</h1>
                <a href="positions/create" class="btn crud-main-cta">&#43; Add Position</a>
            </div>
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Positions</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($positions as $key => $value)
                    <tr>
                        <td>{{ $value->name }}</td>
                        
                        <td class="table-actions">
                             <!-- show the employee (uses the show method found at GET /employees/{id} -->
                            <a class="btn show-btn" title="Show position" href="{{ URL::to('positions/' . $value->id) }}">
                                <i class="fa fa-user fa-lg"></i>
                            </a>

                            <!-- edit this employee (uses the edit method found at GET /employees/{id}/edit -->
                            <a class="btn edit-btn" title="Edit position" href="{{ URL::to('positions/' . $value->id . '/edit') }}">
                                <i class="fa fa-pencil fa-lg"></i>
                            </a>

                                {{ Form::open(array('url' => 'positions/' . $value->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <div title="Delete position">
                                    {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                                </div>
                                <!-- {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }} -->
                             {{ Form::close() }}
                           
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </main>



>>>>>>> 617e117a26d7e829c6eaad2c45ccbf06cc71b61c
@endsection