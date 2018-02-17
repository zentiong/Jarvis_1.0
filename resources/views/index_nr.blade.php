@extends('templates.newsletter-master') 

@section('body')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<?php 
$current_user = Auth::user();
$current_id = Auth::user()->id;
$trainings = $current_user->training_session_id
?>


<p>NORMAL EMPLOYEE LANDING</p>

<p>Skills graph here</p>

@endsection