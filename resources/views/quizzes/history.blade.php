@extends('templates.dashboard-master') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('quizzes-history');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>

@section('body')
  <main class="container-fluid">
      <section class="container">
        <h1 class="crud-page-title">Quizzes History</h1>
        <h4>di ba pwede sa /quizzes to haha</h4>
        @foreach($trainings_attended as $key => $training)
            <p>Training {{$training->title}}</p>
            @foreach($quiz as $key => $q)
                @if($q->training_id == $training->id)
                  @foreach($user_quizzes as $key => $z)
                    @if($z->quiz_id == $q->quiz_id)
                  <p> Quiz Topic: {{$q->topic}}   Score: {{$z->score}}/{{$z->max_score}}</p>
                  @endif
                @endforeach
              @endif

            @endforeach
        
        @endforeach  
      </section>
      
  </main>



@endsection