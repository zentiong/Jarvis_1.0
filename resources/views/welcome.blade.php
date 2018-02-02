@extends('templates.newsletter-master')
@section('body')
    <main>
        <section class="container-fluid" id="calendar-container">
            <div class="container">
                <h1 class="section-label">CALENDAR</h1>
                 @include('calendar_function')
                <?php 
                    if (!isset($_GET['month'])){
                        $month = date('m');
                    }
                    else {
                        $month = $_GET['month'];
                    }

                    if (!isset($_GET['year'])){
                        $year = date('Y');
                    } 
                    else {
                        $year = $_GET['year'];
                    }
                
                    $monthName = date("F", mktime(null, null, null, $month));
                    echo '<div class="text-right month-name"><span class="subsection-label">'.$monthName.' '.$year.'</span></div>';
                ?>
                
                <form method="get" class="text-right">
                    <select name="month" id="month">
                        <?php 
                            $result = '';
                            for($x = 1; $x <= 12; $x++) {
                                $result .= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.date('F',mktime(0,0,0,$x,1,$year)).'</option>';
                            }
                            echo $result;
                        ?> 
                    </select>
                    <select name="year" id="year">
                        <?php
                            $year_range = 7;
                            $result = '';
                            for($x = ($year-floor($year_range/2)); $x <= ($year+floor($year_range/2)); $x++) {
                                $result .= '<option value="'.$x.'"'.($x != $year ? '' : ' selected="selected"').'>'.$x.'</option>';
                        
                            }
                            echo $result;
                        ?>
                    </select>
                    <input type="submit" name="submit" value="Go" /> 
                    <?php /* "next month" control */
                        $next_month_link = '<a href="?month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1).'" class="control">Next Month >></a>';

                        /* "previous month" control */
                        $previous_month_link = '<a href="?month='.($month != 1 ? $month - 1 : 12).'&year='.($month != 1 ? $year : $year - 1).'" class="control"><<  Previous Month</a>'; 
                        echo $previous_month_link;
                        echo $next_month_link;
                    ?>
                </form>
                
                <?php
                    echo draw_calendar($month,$year);
                ?>   
            </div>
            <div class="container">
                <div class="text-right subsection-label-container">
                    <hr class="divider-1">
                    <span class="subsection-label">Quick Links</span>
                </div>
                <div class="row text-center quick-links-container">
                    <!-- HRIS -->
                    <div class="quick-link">
                        <a href="#" target="_blank">
                            <div class="mx-auto img-container">
                                <img class="hris" src="../images/quick-links/hris.png" alt="HRIS">
                            </div>
                            <h5 class="label">HRIS</h5>
                            <span>For checking employee profiles, and filling overtime and work from home applications.</span>
                        </a>
                    </div>
                    <!-- ONLINE PAYSLIP -->
                    <div class="quick-link">
                        <a href="#" target="_blank">
                            <div class="mx-auto img-container">
                                <img class="online-payslip" src="../images/quick-links/payslip.png" alt="Online PaySlip">
                            </div>
                            <h5 class="label">Online PaySlip</h5>
                            <span>For viewing individual pay statements. This can be accessed in BGC, WH, and Hubs.</span>
                        </a>
                    </div>
                    <!-- ORACLE -->
                    <div class="quick-link">
                        <a href="#" target="_blank">
                            <div class="mx-auto img-container">
                                <img class="oracle" src="../images/quick-links/OracleYellow.png" alt="Oracle">
                            </div>
                            <h5 class="label">Oracle</h5>
                            <span>Contains the organization structure of Zalora with sub-departments. Also for filling leaves (VL, SL,CTO, CL, ML,PL, SPL).</span>
                        </a>
                    </div>
                    <!-- WRIKE -->
                    <div class="quick-link">
                        <a href="#" target="_blank">
                            <div class="mx-auto img-container">
                                <img class="wrike" src="../images/quick-links/WrikeYellow.png" alt="Wrike">
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
                <!-- RECRUITMENT -->
                <div class="service-label-container">
                    <span class="hr-service-label">Recruitment</span>
                    <hr class="divider-2">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="hr-service">
                            <a href="#" target="_blank" class="link-wrapper">
                                <img src="../images/hr-services/key.png" alt="Key">
                                <div class="text">
                                    <h6 class="title">On-boarding/ Off-boarding Request for Interns and NFTEs</h6>
                                    <div class="description">
                                        For activation and deactivation of email accounts and access to tools of Interns and NFTEs.
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="hr-service">
                            <a href="#" target="_blank" class="link-wrapper">
                                <img src="../images/hr-services/intern-request.png" alt="Intern Request">
                                <div class="text">
                                    <h6 class="title">Intern Request</h6>
                                    <div class="description">
                                        Manpower request for interns.<br>[Department Heads Only]
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="hr-service">
                            <a href="#" target="_blank" class="link-wrapper">
                                <img src="../images/hr-services/jobs-board.png" alt="Jobs Board">
                                <div class="text">
                                    <h6 class="title">Jobs Board</h6>
                                    <div class="description">
                                        Click to see here our current job openings locally and regionally.
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="hr-service">
                            <a href="#" target="_blank" class="link-wrapper">
                                <img src="../images/hr-services/headcount-request.png" alt="Headcount Request">
                                <div class="text">
                                    <h6 class="title">Headcount Request</h6>
                                    <div class="description">
                                        Manpower request for FTEs, On-calls, and Internal Mobility.<br>[Department Heads Only]
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="hr-service">
                            <a href="#" target="_blank" class="link-wrapper">
                                <img src="../images/hr-services/nfte-request.png" alt="NFTE Request">
                                <div class="text">
                                    <h6 class="title">NFTE Request</h6>
                                    <div class="description">
                                        For agency hiring needs.<br>[Department Heads Only]
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- COMPENSATION & BENEFITS -->
                <div class="service-label-container">
                    <span class="hr-service-label">Compensation &amp; Benefits</span>
                    <hr class="divider-2">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="hr-service">
                            <a href="#" target="_blank" class="link-wrapper">
                                <img src="../images/hr-services/salary-disputes.png" alt="Salary Disputes">
                                <div class="text">
                                    <h6 class="title">Salary Disputes</h6>
                                    <div class="description">
                                        For issues affecting compensation:
                                        <br>- Unrecorded overtime
                                        <br>- Misrecorded undertime
                                        <br>- Misrecorded absences
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="hr-service">
                            <a href="#" target="_blank" class="link-wrapper">
                                <img src="../images/hr-services/change-in-schedule.png" alt="Change in Schedule Request">
                                <div class="text">
                                    <h6 class="title">Change in Schedule Request</h6>
                                    <div class="description">
                                        For requesting change in work schedule due to:
                                        <br>- Schedule conflict
                                        <br>- Special cases
                                        <br>[Must be processed and approved at least one (1) day before the schedule change.]
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="hr-service">
                            <a href="#" target="_blank" class="link-wrapper">
                                <img src="../images/hr-services/coe-request.png" alt="CoE Request">
                                <div class="text">
                                    <h6 class="title">Certificate of Employment Request</h6>
                                    <div class="description">
                                        Document to prove employement in ZALORA.<br>[For FTEs only]
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- EMPLOYEE RELATIONS -->
                <div class="service-label-container">
                    <span class="hr-service-label">Employee Relations</span>
                    <hr class="divider-2">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="hr-service">
                            <a href="#" target="_blank" class="link-wrapper">
                                <img src="../images/hr-services/folder.png" alt="201 Request">
                                <div class="text">
                                    <h6 class="title">201 Request</h6>
                                    <div class="description">
                                        For requesting a copy of any of the following:
                                        <br>- Job contract
                                        <br>- Pre-employement requirements
                                        <br>- Evaluations
                                        <br>- Memos from the company
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="hr-service">
                            <a href="#" target="_blank" class="link-wrapper">
                                <img src="../images/hr-services/return-to-work.png" alt="Return to Work Order Form">
                                <div class="text">
                                    <h6 class="title">Return to Work Order Form</h6>
                                    <div class="description">
                                        Form to be filled to call back to work an employee who was absent for 2 consecutive days without prior notice. 
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- ADMIN -->
                <div class="service-label-container">
                    <span class="hr-service-label">ADMIN</span>
                    <hr class="divider-2">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="hr-service">
                            <a href="#" target="_blank" class="link-wrapper">
                                <img src="../images/hr-services/microbus.png" alt="Shuttle Request">
                                <div class="text">
                                    <h6 class="title">Shuttle Request</h6>
                                    <div class="description">
                                        For shuttle service requests. Requests should be made 2-3 days in advance.
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- OTHER SERVICES -->
            <div class="container">
                <div class="text-right subsection-label-container">
                    <hr class="divider-1">
                    <span class="subsection-label">Other Services</span>
                </div>
                <div class="row other-service-container">
                    <!-- BIRTHDAYS -->
                    <div class="other-service text-center">
                        <a href="#" target="_blank" class="link-wrapper-2">
                            <img src="../images/other-services/birthday.png" alt="Birthdays">
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
                        <a href="#" target="_blank" class="link-wrapper-2">
                            <img src="../images/other-services/gift.png" alt="Employee Perks">
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
                        <a href="#" target="_blank" class="link-wrapper-2">
                            <img src="../images/other-services/diagram.png" alt="Movements">
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
                        <a href="#" target="_blank" class="link-wrapper-2">
                            <img src="../images/other-services/megaphone.png" alt="New Hires">
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
                        <a href="#" target="_blank" class="link-wrapper-2">
                            <img src="../images/other-services/photo-camera.png" alt="Share Your Memoriez">
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
                        <a href="#" target="_blank" class="link-wrapper-2">
                            <img src="../images/other-services/agenda.png" alt="Z-Libary">
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
        <section class="container-fluid" id="policy-portal-container"></section>
    </main>
    
@endsection
