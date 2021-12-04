@extends('layouts.main')
<link rel="stylesheet" href="{{ asset('assets/style/style.css') }}">

@section('title', 'Your Events')
{{-- <link rel="stylesheet" href="{{asset('assets/style/style.css')}}"> --}}
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3  float-left">

                <div class="sidebar">
                    <div>
                        <i class="fa fa-location-arrow mr-3 ml-3" aria-hidden="true"></i>
                        <a class="side_tag" href="{{ '/' }}">Explore events</a>
                    </div>
                    <hr>
                    <div class="sideBarActive active  align-items-center d-flex">
                        <i class="fa fa-calendar mr-3 ml-3" aria-hidden="true"></i>
                        <a class="side_tag" href="#">Your events</a>
                    </div>
                    <hr>
                    <div>
                        <i class="   fa fa-heart mr-3 ml-3" aria-hidden="true"></i>
                        <a class="side_tag" href="{{ 'favrouite' }}"> Favorite events</a>
                    </div>
                    <hr>
                    <div class="align-items-center d-flex">
                        <i class="fa fa-user-plus mr-3 ml-3" aria-hidden="true"></i>
                        <a class="side_tag" href="{{ url('follower') }}">Followers</a>
                    </div>
                    <hr>
                    <div class=" align-items-center d-flex">
                        <i class="fa fa-user mr-3 ml-3" aria-hidden="true"></i>
                        <a class="side_tag" href="{{ url('/following') }}">Following</a>
                    </div>
                    <hr>
                </div>
            </div>
            {{-- <div class="col-md-6 ">
                <div class="top_button">
                    <button id="upcomingBtn" onclick="getUserUpcomingEvents()" class='upcoming'>Upcoming</button>
                    <button id="pastEventsBtn" onclick="getUserPastEvents()" class='past'>Past
                        Events</button>
                    <button id="draftBtn" onclick="getUserDraftEvents()" class='past'>Draft
                        Events</button>
                </div>
                <div class="favEvent">

                </div> --}}
                <div class="col-md-6 col-sm-12 col-12 ">
                    <div class="top_button ">
                        <button class="upcoming">Upcoming</button>
                        <button class="past">Past Events</button>
                        <button class="past mt-2" >Drafts</button>
                    </div>
                    <div class="favourit">
                        <div class="row">
                            <div class="col-2 col-md-2 col-sm-2 imgGap">
                                <img class="eventImage" src="assets/images/favourit1.png" alt="">
                            </div>
                            <div class="col-9 eventsDetailSection">
                                <div class="d-flex clearfix">
                                    <h4 class="title_favourit">New year party at local park</h4>
                                    <img class="heartIcon " src="assets/images/heart.png" alt="">
    
                                </div>
                                <div class="row mb">
                                    <div class="col-4 col-md-4 date">
                                        <img class="fav_title" src="assets/images/date.png" alt="" />
                                        <span class="smallTextGrey">Tomorrow</span>
                                    </div>
                                    <div class="col-4">
                                        <img class="fav_title" src="assets/images/location.png" alt="" />
                                        <span class="smallTextGrey"> 5km away</span>
                                    </div>
                                </div>
    
                                <div class="row ">
                                    <div class="col-md-4 col-sm-3 col-4">
                                        <img class="fav_title" src="assets/images/following.png" alt="" />
                                        <span class="smallTextGrey">10 Following</span>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-4 align-items-center ">
                                        <img class="fav_title" src="assets/images/like.png" alt="" />
                                        <span class="smallTextGrey">20</span>
                                    </div>
    
                                    <div class="col-md-2 col-sm-3 col-4 align-items-center ">
                                        <img class="fav_title" src="assets/images/text.png" alt="">
                                        <span class="smallTextGrey">20</span>
                                    </div>
    
                                    <div class="col-md-3 col-sm-3 col-4 align-items-center">
                                        <img class="fav_title" src="assets/images/forword.png" alt="">
                                        <span class="smallTextGrey">20</span>
                                    </div>
                                </div>
                            </div>
    
                        </div>
                    </div>
                    <div class="favourit">
                        <div class="row">
                            <div class="col-2 col-md-2 col-sm-2 imgGap">
                                <img class="eventImage" src="assets/images/favourit2.png" alt="">
                            </div>
                            <div class="col-9 eventsDetailSection">
                                <div class="d-flex clearfix">
                                    <h4 class="title_favourit">New year party at local park</h4>
                                    <img class="heartIcon " src="assets/images/heart.png" alt="">
    
                                </div>
                                <div class="row mb">
                                    <div class="col-4 col-md-4 date">
                                        <img class="fav_title" src="assets/images/date.png" alt="" />
                                        <span class="smallTextGrey">Tomorrow</span>
                                    </div>
                                    <div class="col-4">
                                        <img class="fav_title" src="assets/images/location.png" alt="" />
                                        <span class="smallTextGrey"> 5km away</span>
                                    </div>
                                </div>
    
                                <div class="row ">
                                    <div class="col-md-4 col-sm-3 col-4">
                                        <img class="fav_title" src="assets/images/following.png" alt="" />
                                        <span class="smallTextGrey">10 Following</span>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-4 align-items-center ">
                                        <img class="fav_title" src="assets/images/like.png" alt="" />
                                        <span class="smallTextGrey">20</span>
                                    </div>
    
                                    <div class="col-md-2 col-sm-3 col-4 align-items-center ">
                                        <img class="fav_title" src="assets/images/text.png" alt="">
                                        <span class="smallTextGrey">20</span>
                                    </div>
    
                                    <div class="col-md-3 col-sm-3 col-4 align-items-center">
                                        <img class="fav_title" src="assets/images/forword.png" alt="">
                                        <span class="smallTextGrey">20</span>
                                    </div>
                                </div>
                            </div>
    
                        </div>
                    </div>
                    <div class="favourit">
                        <div class="row">
                            <div class="col-2 col-md-2 col-sm-2 imgGap">
                                <img class="eventImage" src="assets/images/favourit3.png" alt="">
                            </div>
                            <div class="col-9 eventsDetailSection">
                                <div class="d-flex clearfix">
                                    <h4 class="title_favourit">New year party at local park</h4>
                                    <img class="heartIcon " src="assets/images/heart.png" alt="">
    
                                </div>
                                <div class="row mb">
                                    <div class="col-4 col-md-4 date">
                                        <img class="fav_title" src="assets/images/date.png" alt="" />
                                        <span class="smallTextGrey">Tomorrow</span>
                                    </div>
                                    <div class="col-4">
                                        <img class="fav_title" src="assets/images/location.png" alt="" />
                                        <span class="smallTextGrey"> 5km away</span>
                                    </div>
                                </div>
    
                                <div class="row ">
                                    <div class="col-md-4 col-sm-3 col-4">
                                        <img class="fav_title" src="assets/images/following.png" alt="" />
                                        <span class="smallTextGrey">10 Following</span>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-4 align-items-center ">
                                        <img class="fav_title" src="assets/images/like.png" alt="" />
                                        <span class="smallTextGrey">20</span>
                                    </div>
    
                                    <div class="col-md-2 col-sm-3 col-4 align-items-center ">
                                        <img class="fav_title" src="assets/images/text.png" alt="">
                                        <span class="smallTextGrey">20</span>
                                    </div>
    
                                    <div class="col-md-3 col-sm-3 col-4 align-items-center">
                                        <img class="fav_title" src="assets/images/forword.png" alt="">
                                        <span class="smallTextGrey">20</span>
                                    </div>
                                </div>
                            </div>
    
                        </div>
                    </div>
                </div>

            </div>

            @include('front.right_side')
        </div>
    </div>
@endsection
@section('script')
    <script>
        function getUserPastEvents() {
            $.ajax({
                type: 'GET',
                beforeSend: function() {
                    $('#upcomingBtn').removeClass('upcoming');
                    $('#upcomingBtn').addClass('past');
                    $('#draftBtn').removeClass('upcoming');
                    $('#draftBtn').addClass('past');
                },
                url: '/yourPastEvents',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#pastEventsBtn').addClass('upcoming');
                    $('#pastEventsBtn').removeClass('past');

                    $('.favEvent').html('');
                    if (response.data.length > 0) {
                        $.each(response.data, function(key, data) {
                            console.log(data['events']);
                            var img;
                            var extension = data['events'].event_pictures[0].image_path.split('.')
                                .pop();
                            if (extension == 'mp4' || extension == 'mov') {
                                img = 'download.png';
                            } else {
                                img = data['events'].event_pictures[0].image_path;
                            }

                            var url = "{{ url('eventDetails') }}" + "/" + data['events'].id;
                            $('.favEvent').append("<div class = 'favourit ml-3' >" +
                                "<div class='row'>" +
                                "<div class=''>" +
                                "<a href=" + url + ">" +
                                "<img style='width:90px;height:90px' src=" + img + ">" +
                                "</a>" +
                                "</div>" +
                                "<div class=''>" +
                                "<h4 class='title_favourit ml-3'>" + data['events'].event_name +
                                "</h4>" +
                                "<div class = 'row'>" +
                                "<div class='col-4 date'>" +
                                "<img class='fav_title'" +
                                "<img class='fav_title' src='assets/images/date.png' >" +
                                data['events'].event_date +
                                "</div>" +
                                "<div class='center location'></div>" +
                                "<div class='col-4'>" +
                                "<img class='fav_title' src='assets/images/location.png' >" +
                                data['km'] + " miles" +
                                "</div>" +
                                "</div><br>" +
                                "<div class='row'>" +
                                "<div class='col-4'>" +
                                "<img class='fav_title' src='assets/images/following.png'>" +
                                data['events'].user.followers.length + " Followers" +
                                "</div>" +
                                "<div class='center'></div>" +
                                "<div class='col-2'>" +
                                "<i class='fa fa-thumbs-up'></i>" +
                                data['events'].like.length +
                                "</div>" +
                                "<div class='center'></div>" +
                                "<div class='col-2'>" +
                                "<img class='fav_text' src='assets/images/text.png'>" +
                                "<p class='text'>" + data['events'].comment.length + "</p>" +
                                "</div>" +
                                "<div class='center'></div>" +
                                // "<div class='col-1'>" +
                                // "<img class='fav_text' src='assets/images/forword.png'>" +
                                // "<p class='text'>15</p>" +
                                // "</div>" +
                                "<div class='center'></div>" +
                                "<div class='col-1'>" +
                                "<img class='fav_text' src='assets/images/vid.png'>" +
                                "<p class='text'>" + data['events'].livefeed.length + "</p>" +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "<div class=' text-center align-items-center'>" +
                                "<i onclick='favroute(this)' data-id=" + data['events'].id +
                                "class='fa fa-heart red '></i>" +
                                "<a href=" + url + ">" +
                                "<i class='mt-2  fa fa-info-circle light-grey '></i>" +
                                "  </a>" +
                                "</div>" +
                                "</div>" +
                                "</div>"
                            )
                        })
                    } else {
                        $('.favEvent').append("<h5 class='text-center mt-5'>No Events Available</h5>");
                    }
                }

            });
        }

        function getUserUpcomingEvents() {
            $.ajax({
                type: 'GET',
                beforeSend: function() {
                    $('#loading').show();

                    $('#upcomingBtn').removeClass('past');
                    $('#upcomingBtn').addClass('upcoming');
                    $('#draftBtn').removeClass('upcoming');
                    $('#draftBtn').addClass('past');
                    $('#pastEventsBtn').removeClass('upcoming');
                    $('#pastEventsBtn').addClass('past');
                },
                url: '/yourEvents',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#loading').hide();
                    $('.favEvent').html('');
                    if (response.data.length > 0) {
                        $.each(response.data, function(key, data) {
                            console.log(data['events']);
                            var img;
                            var extension = data['events'].event_pictures[0].image_path.split('.')
                                .pop();
                            if (extension == 'mp4' || extension == 'mov') {
                                img = 'download.png';
                            } else {
                                img = data['events'].event_pictures[0].image_path;
                            }

                            var url = "{{ url('eventDetails') }}" + "/" + data['events'].id;
                            $('.favEvent').append("<div class = 'favourit' >" +
                                "<div class='row'>" +
                                "<div class=''>" +
                                "<a href=" + url + ">" +
                                "<img style='width:90px;height:90px' src=" + img + ">" +
                                "</a>" +
                                "</div>" +
                                "<div class=''>" +
                                "<h4 class='title_favourit ml-3'>" + data['events'].event_name +
                                "</h4>" +
                                "<div class = 'row ml-2'>" +
                                "<div class='col-6 date '>" +
                                "<img class='fav_title mr-4'" +
                                "<img class='fav_title mr-4' src='assets/images/date.png' >" +
                                data['events'].event_date +
                                "</div>" +
                                "<div class='center location ml-3'></div>" +
                                "<div class='col-6 mr-4'>" +
                                "<img class='fav_title mr-4' src='assets/images/location.png' >" +
                                data['km'] + " miles" +
                                "</div>" +
                                "</div><br>" +
                                "<div class='row'>" +
                                "<div class='col-4'>" +
                                "<img class='fav_title ' src='assets/images/following.png'>" +
                                data['events'].user.followers.length + " Followers" +
                                "</div>" +
                                "<div class='center'></div>" +
                                "<div class='col-2'>" +
                                "<i class='fa fa-thumbs-up'></i>" +
                                data['events'].like.length +
                                "</div>" +
                                "<div class='center'></div>" +
                                "<div class='col-2'>" +
                                "<img class='fav_text' src='assets/images/text.png'>" +
                                "<p class='text'>" + data['events'].comment.length + "</p>" +
                                "</div>" +
                                "<div class='center'></div>" +
                                // "<div class='col-1'>" +
                                // "<img class='fav_text' src='assets/images/forword.png'>" +
                                // "<p class='text'>15</p>" +
                                // "</div>" +
                                "<div class='center'></div>" +
                                "<div class='col-1'>" +
                                "<img class='fav_text' src='assets/images/vid.png'>" +
                                "<p class='text'>" + data['events'].livefeed.length + "</p>" +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "<div class=' text-center align-items-center'>" +
                                "<i onclick='favroute(this)' data-id=" + data['events'].id +
                                "class='fa fa-heart red '></i>" +
                                "<a href=" + url + ">" +
                                "<i class='mt-2  fa fa-info-circle light-grey '></i>" +
                                "  </a>" +
                                "</div>" +
                                "</div>" +
                                "</div>"
                            )
                        })
                    } else {
                        $('.favEvent').append("<h5 class='text-center mt-5'>No Events Available</h5>");
                    }
                }
            }).done(function() {
                $('#loading').hide();

            });
        }


        function getUserDraftEvents() {
            $.ajax({
                type: 'GET',
                beforeSend: function() {
                    $('#pastEventsBtn').removeClass('upcoming');
                    $('#upcomingBtn').removeClass('upcoming');
                    $('#upcomingBtn').addClass('past');
                    $('#pastEventsBtn').addClass('past');
                },
                url: '/yourDraftEvents',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#draftBtn').addClass('upcoming');
                    $('#draftBtn').removeClass('past');

                    $('.favEvent').html('');
                    if (response.data.length > 0) {
                        $.each(response.data, function(key, data) {
                            console.log(data['events']);
                            var img;
                            var extension = data['events'].event_pictures[0].image_path.split('.')
                                .pop();
                            if (extension == 'mp4' || extension == 'mov') {
                                img = 'download.png';
                            } else {
                                img = data['events'].event_pictures[0].image_path;
                            }


                            var url = "{{ url('eventDetails') }}" + "/" + data['events'].id;
                            $('.favEvent').append("<div class = 'favourit' >" +
                                "<div class='row'>" +
                                "<div class=''>" +
                                "<a href=" + url + ">" +
                                "<img style='width:90px;height:90px' src=" + img + ">" +
                                "</a>" +
                                "</div>" +
                                "<div class=''>" +
                                "<h4 class='title_favourit'>" + data['events'].event_name +
                                "</h4>" +
                                "<div class = 'row'>" +
                                "<div class='col-4 date'>" +
                                "<img class='fav_title'" +
                                "<img class='fav_title' src='assets/images/date.png' >" +
                                data['events'].event_date +
                                "</div>" +
                                "<div class='center location'></div>" +
                                "<div class='col-4'>" +
                                "<img class='fav_title' src='assets/images/location.png' >" +
                                data['km'] + "miles" +
                                "</div>" +
                                "</div><br>" +
                                "<div class='row'>" +
                                "<div class='col-4'>" +
                                "<img class='fav_title' src='assets/images/following.png'>" +
                                data['events'].user.followers.length + " Followers" +
                                "</div>" +
                                "<div class='center'></div>" +
                                "<div class='col-2'>" +
                                "<img class='fav_title' src='assets/images/like.png'>" +
                                "20" +
                                "</div>" +
                                "<div class='center'></div>" +
                                "<div class='col-2'>" +
                                "<img class='fav_text' src='assets/images/text.png'>" +
                                "<p class='text'>12</p>" +
                                "</div>" +
                                "<div class='center'></div>" +
                                "<div class='col-1'>" +
                                "<img class='fav_text' src='assets/images/forword.png'>" +
                                "<p class='text'>15</p>" +
                                "</div>" +
                                "<div class='center'></div>" +
                                "<div class='col-1'>" +
                                "<img class='fav_text' src='assets/images/vid.png'>" +
                                "<p class='text'>40</p>" +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "<div class=' text-center align-items-center'>" +
                                "<i onclick='favroute(this)' data-id=" + data['events'].id +
                                "class='fa fa-heart red '></i>" +
                                "<a href=" + url + ">" +
                                "<i class='mt-2  fa fa-info-circle light-grey '></i>" +
                                "  </a>" +
                                "</div>" +
                                "</div>" +
                                "</div>"
                            )
                        })
                    } else {
                        $('.favEvent').append("<h5 class='text-center mt-5'>No Events Available</h5>");
                    }
                }

            });
        }

        function favroute(icon, eventId) {
            var id = $(icon).attr('data-id');
            if ($(icon).hasClass("light-grey")) {
                $.ajax({
                    type: 'POST',
                    url: '/saveFavrouite',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'event_id': id,
                    }
                }).done(function(msg) {
                    showToaster(msg.message, 'success');
                    $(icon).removeClass('light-grey');
                    $(icon).addClass('red');
                })
            } else if ($(icon).hasClass('red')) {
                $.ajax({
                    type: 'POST',
                    url: '/deleteFavrouite',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'event_id': id,
                    }
                }).done(function(msg) {
                    showToaster(msg.message, 'success');
                    $(icon).addClass('light-grey');
                    $(icon).removeClass('red');
                })
            }
        }

        window.onload = function() {
            getUserUpcomingEvents();
        };
    </script>
@endsection
