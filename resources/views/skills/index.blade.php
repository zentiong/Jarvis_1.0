@extends('templates.dashboard-master') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('skills');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>

@section('body')

    <main class="container-fluid">
        <section class="container-fluid">
            <div class="row crud-page-top">
                <h1 class="crud-page-title">All Skills</h1>
                <a href="skills/create" class="btn crud-main-cta">&#43; Add Skill</a>
            </div>

            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <?php 
            $user_id = Auth::user()->id;
            ?>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Skill ID</td>
                        <td>Skill Name</td>
                        <td>Options</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($skills as $key => $value)
                    <tr>
                        

                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name}}</td>

                        <td class="table-actions">
                            <a class="btn edit-btn" title="Edit skill" href="{{ URL::to('skills/' . $value->id . '/edit') }}">
                                <i class="fa fa-pencil fa-lg"></i>
                            </a>
                            {{ Form::open(array('url' => 'skills/' . $value->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            <div title="Delete skill">
                                <!-- {{ Form::submit('Delete', array('class' => 'btn delete-btn')) }} -->
                                {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                            </div>
                            
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>

        </section>
    </main>

@endsection