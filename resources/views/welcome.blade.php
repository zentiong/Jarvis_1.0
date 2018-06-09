<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jarvis 1.0 - ENTREGO</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
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
                <h1>JARVIS 1.0</h1>
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
            <div class="container">
                <div class="text-right subsection-label-container">
                    <hr class="divider-1">
                    <span class="subsection-label">Quick Links</span>
                </div>
                <div class="row text-center quick-links-container">
                    <!-- HRIS -->
                    <div class="quick-link">
                        <a href="http://intranet.zalphil.com/hris/" target="_blank" rel="noopener">
                            <div class="mx-auto img-container">
                                <img class="hris" data-src="{{ asset('images/quick-links/hris.png')}}" alt="HRIS">
                            </div>
                            <h5 class="label">HRIS</h5>
                            <span>For checking employee profiles, and filling overtime and work from home applications.</span>
                        </a>
                    </div>
                    <!-- ONLINE PAYSLIP -->
                    <div class="quick-link">
                        <a href="http://intranet.zalphil.com/online-paystatement/" target="_blank" rel="noopener">
                            <div class="mx-auto img-container">
                                <img class="online-payslip" data-src="{{ asset('images/quick-links/payslip.png')}}" alt="Online PaySlip">
                            </div>
                            <h5 class="label">Online PaySlip</h5>
                            <span>For viewing individual pay statements. This can be accessed in BGC, WH, and Hubs.</span>
                        </a>
                    </div>
                    <!-- ORACLE -->
                    <div class="quick-link">
                        <a href="https://hcch.hcm.em2.oraclecloud.com/" target="_blank" rel="noopener">
                            <div class="mx-auto img-container">
                                <img class="oracle" data-src="{{ asset('images/quick-links/OracleYellow.png')}}" alt="Oracle">
                            </div>
                            <h5 class="label">Oracle</h5>
                            <span>Contains the organization structure of Zalora with sub-departments. Also for filling leaves (VL, SL,CTO, CL, ML,PL, SPL).</span>
                        </a>
                    </div>
                    <!-- WRIKE -->
                    <div class="quick-link">
                        <a href="https://www.wrike.com/workspace.htm" target="_blank" rel="noopener">
                            <div class="mx-auto img-container">
                                <img class="wrike" data-src="{{ asset('images/quick-links/WrikeYellow.png')}}" alt="Wrike">
                            </div>
                            <h5 class="label">Wrike</h5>
                            <span>For requests regarding procurement for different projects under the company. [Limited Access]</span>
                        </a>
                    </div>
                </div>
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
                                        $logo = asset('images/link_photos/'.$policy->logo);
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


                    <!-- LEFT -->
                    <div class="col-md-6">
                        <!-- BENEFIT PAGE -->
                        <div class="policy">
                            <a href="https://drive.google.com/open?id=0B68wCGt4E6QgZkdzSWxoV3VoTG8" target="_blank" rel="noopener" class="link-wrapper-3">
                                <img data-src="{{ asset('images/policy-portal/employee.png')}}" alt="Benefit Page">
                                <div class="text">
                                    <h5 class="title">Benefit Page</h5>
                                    <div class="description">
                                        List of benefits available for all employee of ZALORA. [Contains guidelines on how to avail and manage benefits]
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- OPE GUIDELINES -->
                        <div class="policy">
                            <a href="https://drive.google.com/open?id=0B68wCGt4E6Qgc0dqcEk1enRtN3c" target="_blank" rel="noopener" class="link-wrapper-3">
                                <img data-src="{{ asset('images/policy-portal/invoice.png')}}" alt="OPE Guidelines">
                                <div class="text">
                                    <h5 class="title">OPE Guidelines</h5>
                                    <div class="description">
                                        Guidelines on how involved employees can liquidate valid receipts.
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- HR TIMEKEEPING POLICY -->
                        <div class="policy">
                            <a href="https://drive.google.com/open?id=0B68wCGt4E6Qgbk5GclBtdjZKSUk" target="_blank" rel="noopener" class="link-wrapper-3">
                                <img data-src="{{ asset('images/policy-portal/alarm-clock.png')}}" alt="HR Timekeeping Policy">
                                <div class="text">
                                    <h5 class="title">HR Timekeeping Policy</h5>
                                    <div class="description">
                                        Rules concerning how hours (undertime, overtime, or absences) are taken into account for employee compensation.
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- RIGHT -->
                    <div class="col-md-6">
                        <!-- EMPLOYEE HANDBOOK -->
                        <div class="policy">
                            <a href="https://drive.google.com/open?id=0B8KFcMH_9clsUlp2VTVxdHZ1T2c" target="_blank" rel="noopener" class="link-wrapper-3">
                                <img data-src="{{ asset('images/policy-portal/notebook.png')}}" alt="Employee Handbook">
                                <div class="text">
                                    <h5 class="title">ZALORA Employee Handbook</h5>
                                    <div class="description">
                                        For access to the company handbook. Find guidelines on company procedures, policies, and culture here.
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- CODE OF CONDUCT -->
                        <div class="policy">
                            <a href="https://drive.google.com/open?id=0B68wCGt4E6QgYndEWFBudV9wY2phQkR5YXhrcDhJR3ZiRXJr" target="_blank" rel="noopener" class="link-wrapper-3">
                                <img data-src="{{ asset('images/policy-portal/agenda.png')}}" alt="Code of Conduct">
                                <div class="text">
                                    <h5 class="title">Code of Conduct</h5>
                                    <div class="description">
                                        ZALORA PH's business principles.
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- NON-TRADE TIMELINE -->
                        <div class="policy">
                            <a href="https://drive.google.com/open?id=0B68wCGt4E6QgTUVlZzVXNHFOSzg" target="_blank" rel="noopener" class="link-wrapper-3">
                                <img data-src="{{ asset('images/policy-portal/choices.png')}}" alt="Non-Trade Timeline">
                                <div class="text">
                                    <h5 class="title">Non-Trade Timeline</h5>
                                    <div class="description">
                                        Requirements and process timeline when requesting for a non-trade item or service with Admin via Wrike.
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="container-fluid" id="engagements-container">
            <div class="container">
                <h1 class="section-label">ENGAGEMENTS</h1>
            </div>
            <div class="container">
                <!-- BAP / ZECC -->
                <div class="engagement bap">
                    <a href="https://www.zalora.com.ph/bap/" target="_blank" rel="noopener">
                        <img data-src="{{ asset('images/engagements/BAP.png') }}" alt="BAP">
                    </a>
                    <a href="https://drive.google.com/open?id=0B68wCGt4E6QgRXRLZ0JreTBkTFU" target="_blank" rel="noopener">
                        <span>ABOUT ZECC</span>
                    </a>
                </div>
                <!-- ASK ZALORA PH -->
                <div class="engagement ask-zalora">
                    <a href="http://freesuggestionbox.com/pub/ynhudtu" target="_blank" rel="noopener">
                        <span>Got concerns or suggestions but you're too shy to voice them out? Submit them at our anonymous message box!</span>
                        <span>AskZaloraPH</span>
                    </a>
                </div>
                <!-- Z-LIBRARY -->
                <div class="engagement z-library text-center">
                    <div class="title">Z-Library</div>
                    <ul>
                        <li>
                            <a href="https://drive.google.com/open?id=0B68wCGt4E6QgTzBWdWxhU3U0Sm8">
                                <img data-src="{{ asset('images/engagements/procedures.png') }}" alt="Procedures">
                            </a>
                        </li>
                        <li>
                            <a href="https://awesome-table.com/-KuRu48pL633raFqMpPH/view">
                                <img data-src="{{ asset('images/engagements/catalogue.png') }}" alt="Catalogue">
                            </a>
                        </li>
                        <li>
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSdlSkaZltyvtmcIqkNkZX98CYftGOUAdNOCkxBoNsRIzswJbw/viewform">
                                <img data-src="{{ asset('images/engagements/borrow.png') }}" alt="Borrow">
                            </a>
                        </li>
                        <li>
                            <a href="https://tinyurl.com/ZLIBBookRequest">
                                <img data-src="{{ asset('images/engagements/request.png') }}" alt="Request">
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- LEARN UP BANNER -->
                <div class="engagement learn-up-banner">
                    <img data-src="{{ asset('images/engagements/learn-up-logo.png') }}" alt="Learn Up Logo">
                    <span>INSTRUCTOR SIGN-UP</span>
                    <span>LEARN-UP DRIVE</span>
                </div>
                <!-- MEMORIEZ / ZCOOP -->
                <div class="engagement memoriez-zcoop">
                    <a href="https://drive.google.com/drive/folders/0B2ehw7WQ8Dk3TTFTSDVJQXF0MlE?usp=sharing" class="memoriez">
                        <div class="top-text text-center">
                            Share Your MemorieZ:
                        </div>
                        <div class="bottom-text">
                            Upload your pictures and videos in our community drive!
                        </div>
                    </a>
                    <a href="https://drive.google.com/open?id=0B68wCGt4E6Qgb1JuMTNwWl9jek0" class="zcoop">
                        <div class="top-text text-center">
                            Zcoop Database:
                        </div>
                        <div class="bottom-text">
                            Check out past Zcoops here!
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <section class="container-fluid" id="hr-corp-container">
            <div class="container">
                <h1 class="section-label">HR CORPORATE SERVICE 2.0</h1>
            </div>
            <div class="container">
                <div class="hr-corp-row">
                    <!-- DL -->
                    <div class="hr-corp-single">
                        <img data-src="{{ asset('images/hr-corp/DL.png') }}" alt="DL">
                        <div class="label">
                            <h6>Flip DL Ruby</h6>
                            <small>Department Head of HR and Corporate Services 2.0</small>
                        </div>
                    </div>
                    <!-- GLENDA -->
                    <div class="hr-corp-single">
                        <img data-src="{{ asset('images/hr-corp/Glenda.png') }}" alt="Glenda">
                        <div class="label">
                            <h6>Glenda Hernandez</h6>
                            <small>HR Business Partner</small>
                        </div>
                    </div>
                    <!-- MARIEL -->
                    <div class="hr-corp-single">
                        <img data-src="{{ asset('images/hr-corp/Mariel.png') }}" alt="Mariel">
                        <div class="label">
                            <h6>Mariel Caidic</h6>
                            <small>Compensation &amp; Benefits Officer</small>
                        </div>
                    </div>
                    <!-- FAYE -->
                    <div class="hr-corp-single">
                        <img data-src="{{ asset('images/hr-corp/Faye.png') }}" alt="Faye">
                        <div class="label">
                            <h6>Faye Tresvalles</h6>
                            <small>Recruitment Officer</small>
                        </div>
                    </div>
                    <!-- KATH -->
                    <div class="hr-corp-single">
                        <img data-src="{{ asset('images/hr-corp/KB.png') }}" alt="Kath">
                        <div class="label">
                            <h6>Kath Barco</h6>
                            <small>Regional Talent Acquisition</small>
                        </div>
                    </div>
                    <!-- ANNE -->
                    <div class="hr-corp-single">
                        <img data-src="{{ asset('images/hr-corp/Anne.png') }}" alt="Anne">
                        <div class="label">
                            <h6>Anne Liangco</h6>
                            <small>Entrepreneur-in-Residence</small>
                        </div>
                    </div>
                    <!-- MARY -->
                    <div class="hr-corp-single">
                        <img data-src="{{ asset('images/hr-corp/Cat.png') }}" alt="Mary">
                        <div class="label">
                            <h6>Mary Catherine Naguit</h6>
                            <small>Manager (Administration and Procurement)</small>
                        </div>
                    </div>
                    <!-- ARCHIE -->
                    <div class="hr-corp-single">
                        <img data-src="{{ asset('images/hr-corp/Archie.png') }}" alt="Archie">
                        <div class="label">
                            <h6>Archie Del Mundo</h6>
                            <small>Senior Executive (Procurement)</small>
                        </div>
                    </div>
                    <!-- RICHARD -->
                    <div class="hr-corp-single">
                        <img data-src="{{ asset('images/hr-corp/Richard.png') }}" alt="Richard">
                        <div class="label">
                            <h6>Richard Ayuban</h6>
                            <small>Administrative Executive</small>
                        </div>
                    </div>
                    <!-- JOHN -->
                    <div class="hr-corp-single">
                        <img data-src="{{ asset('images/hr-corp/Pat.png') }}" alt="John">
                        <div class="label">
                            <h6>John Patrick Avilla</h6>
                            <small>Procurement Officer</small>
                        </div>
                    </div>
                    <!-- APRIL -->
                    <div class="hr-corp-single">
                        <img data-src="{{ asset('images/hr-corp/April.png') }}" alt="April">
                        <div class="label">
                            <h6>April de Guzman</h6>
                            <small>Administrative Assistant</small>
                        </div>
                    </div>
                    <!-- J-ANN -->
                    <div class="hr-corp-single">
                        <img data-src="{{ asset('images/hr-corp/Jae Sy.png') }}" alt="J-Ann">
                        <div class="label">
                            <h6>J-Ann Sy</h6>
                            <small>Regional Travel Specialist</small>
                        </div>
                    </div>
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