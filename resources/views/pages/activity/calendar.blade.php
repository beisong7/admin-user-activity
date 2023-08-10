

@extends('layouts.app')

@section('page_title')
    <div class="pagetitle">
        <h1>Calendar</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" ><a href="{{ route('dashboard') }}">dashboard</a></li>
            <li class="breadcrumb-item">Activity</li>
            <li class="breadcrumb-item active">Calendar</li>
        </ol>
        </nav>
    </div><!-- End Page Title -->
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/calendarorganizer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
@endsection

@section('custom_js')
    <script src="{{ asset('js/calendarorganizer.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/calendar.js') }}" type="text/javascript"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            var calendarDay = document.querySelectorAll('.cjslib-day-listed');

            Array.from(calendarDay).forEach(link => {
                link.addEventListener('click', function(event) {
                    // console.log('clicked something');
                    // console.log(this.firstChild.innerHTML);
                    let xmonth = organizer.calendar.date.getMonth();
                    let xday = organizer.calendar.date.getDate();
                    let xyear = organizer.calendar.date.getFullYear();
                    xmonth++;
                    xdates = `${xyear}-${xmonth}-${xday}`;
                    console.log(xdates);
                    document.getElementById("hiddendate").value = xdates;
                    document.getElementById("dateadded").innerHTML = xdates;

                    var buttonenably = document.getElementById('myButton');
                    buttonenably.disabled = false;


                    // if (!confirm(`sure u want to delete ${this.title}`)) {
                    //     event.preventDefault();
                    // }
                });
            });
            // Your code to run since DOM is loaded and ready
        });
    </script>
    <script>
        "use strict"
        var listdates = <?php echo(json_encode($dates)); ?>

        let datedata = {
            2023: {
                6 :{},
                7 :{},
                8 :{
                    1 : [],
                    2 : [],
                    3 : [],
                    4 : [],
                    5 : [],
                    6 : [],
                    7 : [],
                    8 : [],
                    9 : [],
                    10 : [],
                    11 : [],
                    12 : [],
                    13 : [],
                    14 : [],
                    15 : [],
                    16 : [],
                    17 : [],
                    18 : [],
                    19 : [],
                    20 : [],
                    21 : [],
                    22 : [],
                    23 : [],
                    24 : [],
                    25 : [],
                    26 : [],
                    27 : [],
                    28 : [],
                    29 : [],
                    30 : [],
                },
                9 :{},
                10 :{},

            }
        };

        listdates.forEach(manage);

        function manage(item){
            let xdate = new Date(item.date)
            let xyear = xdate.getFullYear();
            let xmonth = xdate.getMonth()+1;
            let xday = xdate.getDate()+1;

            datedata[xyear][xmonth][xday].push(
                {
                    endTime: "",
                    startTime: item.type,
                    text: item.title
                }
            )


            console.log(xday, xmonth, xyear, item.title, item.type);
        }
        console.log(listdates);
        console.log(datedata);

        var calendar = new Calendar(
            "calendarContainer", // id of html container for calendar
            "medium", // size of calendar, can be small | medium | large
            [
                "Sunday", // left most day of calendar labels
                3 // maximum length of the calendar labels
            ],
            [
                "#E91E63", // primary color
                "#C2185B", // primary dark color
                "#FFFFFF", // text color
                "#F8BBD0" // text dark color
            ]
        );

        // initializing a new organizer object, that will use an html container to create itself
        var organizer = new Organizer(
        "organizerContainer", // id of html container for calendar
        calendar, // defining the calendar that the organizer is related to
        datedata // giving the organizer the static data that should be displayed
        );


    </script>
@endsection

@section('content')

<div class="clearfix mb-3">
    @include('layouts.notice')
</div>

    <section class="section clearfix">

        <div id="calendarContainer"></div>
        <div id="organizerContainer"></div>
    </section>



    <div class="row clearfix">

        <div class="col-md-12 mt-3">
            <p>select date to enable button</p>
            <button type="button" class="btn btn-primary enably" id="myButton" disabled data-bs-toggle="modal" data-bs-target="#verticalycentered">
                ADD NEW ACTIVITY
              </button>
              <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ route('activity.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="" name="date" class="hidden-date" id="hiddendate">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">New Activity for <span id="dateadded"></span></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">* Title</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="">* Description</label>
                                    <input type="text" name="description" class="form-control" required>
                                </div>

                                <br>
                                <div class="form-group mb-3">
                                    <label for="">Image</label>
                                    <input type="file" name="image" class="form-control" >
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create Activity</button>
                            </div>
                        </div>
                    </form>

                </div>
              </div><!-- End Vertically centered Modal-->
        </div>
    </div>
@endsection


