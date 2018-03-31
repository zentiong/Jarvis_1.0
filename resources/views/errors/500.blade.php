@extends('templates.dashboard-master')

@section('body')
    <main class="container">
        <section class="row crud-page-top">
            <div class="error-page" style="margin-bottom: 10em;">
                <h2 class="crud-page-title">Error 500</h2>
                <div class="error-content">
                    <h3><i class="fa fa-warning text-yellow"></i> Oops! Something's gone wrong on the server.</h3>
                    <p>
                        You can try reloading the page, or <a href="{{ url()->previous() }}">return to the previous screen</a>.
                    </p>
                </div>
            </div>
        </section>
    </main>
    
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>