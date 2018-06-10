<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jarvis - ENTREGO</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
    <link rel="mask-icon" href="{{ asset('favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" as="style" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" as="style" type="text/css" href="{{ asset('css/app.css') }}">
    <noscript>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    </noscript>

    <link rel="stylesheet" as="style" type="text/css" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <noscript>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </noscript>


    
</head>

<body class="newsletter">
    @extends('templates.newsletter-navbar')

    <main>
         <!-- will be used to show any messages -->
        @if (Session::has('message'))    
        <div class="login-error-wrapper" id="login-error-wrapper" onclick="closeLoginError()">
            <div class="help-block">
                <i class="fa fa-exclamation-triangle fa-lg"></i>
                <strong>{{ Session::get('message') }}. Contact HR or tech for support.</strong>
            </div>
            <button class="btn">
                CLOSE
            </button>
        </div>
        @endif
        <section class="container-fluid text-center" id="welcome-banner">
            <div class="container">
                <h1>JARVIS</h1>
                <h5>Your upgraded personal HR Corp Serv assistant.</h5>
            </div>
        </section>
        <section class="container-fluid" id="calendar-container" >
            <div class="container">
                <h1 class="section-label">CALENDAR</h1>
                 @include('calendar_function')

                <div class="text-center month-name">{{$monthName.' '.$year}}</div>
                
                <form method="get" class="row month-main-control">
                
                <a href="{{ url('/date', ['month'=> $prevMonth, 'year' => $prevYear])}}" class="month-control"><< Previous Month</a>

                <a href="{{ url('/date', ['month'=> $nextMonth, 'year' => $nextYear])}}" class="month-control">Next Month >></a>
                    
                </form>
                <div class="horizontal-scroll">
                    <?php
                        echo draw_calendar($month,$year,$temp);
                    ?>
                </div>
                <p class="text-center">To sign up for events and trainings, log in to your account.</p>   
            </div>         
        </section>  
        <section class="container-fluid" id="services-container">
            <div class="container">
                <h1 class="section-label">SERVICES</h1>
            </div>
            <!-- HR SERVICES -->
            <div class="container">
            <div class="text-right subsection-label-container">
                    <hr class="divider-1">
                    <span class="subsection-label">HR Services</span>
                </div>
            @foreach($services as $key => $service)
                <div class="service-label-container">
                    <span class="hr-service-label">{{$service->name}}</span>
                    <hr class="divider-2">
                </div>
                <div class="row">
                @foreach($links as $key => $link)
                    @if($link->service_id == $service->id)
                        <div class="col-md-6">
                            <div class="hr-service">
                                <a href="{{$link->link}}" target="_blank"  rel="noopener" class="link-wrapper">
                                    <?php
                                        $logo = asset('images/link_photos/'.$link->logo);
                                    ?>
                                    <img data-src="{{ $logo }}" alt="{{$link->title}}">
                                    <div class="text">
                                        <h6 class="title">{{$link->title}}</h6>
                                        <div class="description">
                                           {{ $link->description }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
                </div>
            @endforeach
            </div>


            <!-- 
            TEST
            -->
            <!-- OTHER SERVICES -->
            <div class="container">
                <div class="text-right subsection-label-container">
                    <hr class="divider-1">
                    <span class="subsection-label">Other Services</span>
                </div>
                <div class="row other-service-container">
                    <!-- BIRTHDAYS -->
                    <div class="other-service text-center">
                        <a href="#" target="_blank"  rel="noopener" class="link-wrapper-2">
                            <img data-src="{{ asset('images/other-services/birthday.png')}}" alt="Birthdays">
                            <div class="text">
                                <h6 class="title">Birthdays</h6>
                                <div class="description">
                                    Check out this month's birthday celebrants!
                                </div>
                            </div>
                         </a>
                    </div>
                    <!-- EMPLOYEE PERKS -->
                    <div class="other-service text-center">
                        <a href="#" target="_blank" rel="noopener" class="link-wrapper-2">
                            <img data-src="{{ asset('images/other-services/gift.png')}}" alt="Employee Perks">
                            <div class="text">
                                <h6 class="title">Employee Perks</h6>
                                <div class="description">
                                        Check out new employee perks here!
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- MOVEMENTS -->
                    <div class="other-service text-center">
                        <a href="#" target="_blank" rel="noopener" class="link-wrapper-2">
                            <img data-src="{{ asset('images/other-services/diagram.png')}}" alt="Movements">
                            <div class="text">
                                <h6 class="title">Movements</h6>
                                <div class="description">
                                        Congratulate our newly promoted Zalorians!
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- NEW HIRES -->
                    <div class="other-service text-center">
                        <a href="#" target="_blank" rel="noopener" class="link-wrapper-2">
                            <img data-src="{{ asset('images/other-services/megaphone.png')}}" alt="New Hires">
                            <div class="text">
                                <h6 class="title">New Hires</h6>
                                <div class="description">
                                        Get to know our newest Zalorians for the month!
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- SHARE YOUR MEMORIEZ -->
                    <div class="other-service text-center">
                        <a href="#" target="_blank" rel="noopener" class="link-wrapper-2">
                            <img data-src="{{ asset('images/other-services/photo-camera.png')}}" alt="Share Your Memoriez">
                            <div class="text">
                                <h6 class="title">Share Your Memoriez</h6>
                                <div class="description">
                                        Share your event pictures here!
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Z-LIBRARY -->
                    <div class="other-service text-center">
                        <a href="#" target="_blank" rel="noopener" class="link-wrapper-2">
                            <img data-src="{{ asset('images/other-services/agenda.png')}}" alt="Z-Libary">
                            <div class="text">
                                <h6 class="title">Z-Library</h6>
                                <div class="description">
                                        Browse, request, and borrow books from our very own library!
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>  
        </section>
        <section class="container-fluid" id="policy-container">
            <div class="container">
                <h1 class="section-label">POLICY PORTAL</h1>
            </div>
            <div class="container">
                <div class="row policy-portal-container">

                    @foreach($policies as $key => $policy)

                        <div class="col-md-6">
                            <div class="policy">
                                <a href="{{$policy->link}}" target="_blank" rel="noopener" class="link-wrapper-3">
                                    <?php
                                        $logo = asset('images/policy_photos/'.$policy->logo);
                                    ?>
                                <img data-src="{{ $logo }}" alt="{{$policy->title}}">
                                <div class="text">
                                    <h5 class="title">{{$policy->title}}</h5>
                                    <div class="description">
                                        {{$policy->description}}
                                    </div>
                                </div>
                            </a>

                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </section>
        <section class="container-fluid" id="hr-corp-container">
            <div class="container">
                <h1 class="section-label">HR CORPORATE SERVICE 2.0</h1>
            </div>
            <div class="container">
                <div class="hr-corp-row">
                    @foreach($hrs as $key => $hr)
                        <div class="hr-corp-single">
                        <?php
                            $photo = asset('images/hr_photos/'.$hr->photo);
                        ?>
                        <img data-src="{{ $photo }}" alt="{{$hr->name}}">
                        <div class="label">
                            <h6>{{$hr->name}}</h6>
                            <small>{{$hr->position}}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
    @extends('templates.newsletter-footer')

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script type="text/javascript">
        function hideShowLogin() {
            console.log(window.pageYOffset);
            var x = document.getElementById('login-popup');
            var y = document.getElementById('login-button-yellow');
            if (x.style.display === "block") {
                x.style.display = "none";
                y.classList.remove('clicked');
            }
            else {
                x.style.display = "block";
                y.classList.add('clicked');
            }
        }
        function closeLoginError() {
            var x = document.getElementById('login-error-wrapper');
            x.style.display = "none";
        }
        function scrollPos() {
            var x = document.getElementById('services-container').scrollTop;
            console.log(window.pageYOffset);
        }

        if (typeof jquery == 'undefined') {
            console.log("no jquery");
        }

        (function(w, d){
            var b = d.getElementsByTagName('body')[0];
            var s = d.createElement("script"); s.async = true;
            var v = !("IntersectionObserver" in w) ? "8.7.1" : "10.5.2";
            s.src = "https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/" + v + "/lazyload.min.js";
            w.lazyLoadOptions = {}; // Your options here. See "recipes" for more information about async.
            b.appendChild(s);
        }(window, document));
        var myLazyLoad = new LazyLoad();
        // https://www.andreaverlicchi.eu/lazyload/
    </script>

</body> 

</html>