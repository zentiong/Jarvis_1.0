@extends('templates.dashboard-master')  


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
        
        <section class="row personal-details nr-pastel">

        @include('templates.dashboard-profile_photo', ['current_user' => $current_user, 'current_id' => $current_id])

        <section class="container dashboard-container">
            @include('templates.dashboard-skills')

            @include('templates.dashboard-trainings')

        </section>
			
       
        
        <?php 
        $evals_to_take = array(); // user trainings where quiz has already been training
        ?>
       
		</section>
	</main>

@endsection


