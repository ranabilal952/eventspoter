@extends('layouts.main')
@section('title', 'HomePage')
<style>
    .modal-dialog {
        position: absolute !important;
        left: 0 !important;
        right: 0 !important;
        top: 20px !important;
    }

</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('front.left_side')
            <div class="col-md-6 mx-auto">
                <div class="createEventBG">
                    <a class="create_account text-white" href="#" data-toggle="modal" data-target="#createEventModal"><img
                            src="{{ asset('assets/images/plus.png') }}" alt="">
                        Create
                        a new event</a>
                </div>
                @include('front.includes.livefeed')
                <div class="eventsNearYouSection ">
                    <p class=" ml-1 normal-text">Events near you</p>
                    @if (count($nearEvents) > 0)
                        @foreach ($nearEvents as $event)
                            @if (count($event['events']->eventPictures) > 0)
                                <div class="eventsNearYouBG"
                                    style="  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                                                                                                                                                                                                                    ">
                                    <div class="eventsNearYou">
                                        <a href="{{ url('eventDetails/' . $event['events']->id) }}">
                                            @if (Str::substr($event['events']->eventPictures[0]->image_path, -3) == 'mp4' || Str::substr($event['events']->eventPictures[0]->image_path, -3) == 'mov')
                                                <video class="eventBgImage mr-3"
                                                    src="{{ asset($event['events']->eventPictures[0]->image_path) }}"
                                                    controls>
                                                    <source
                                                        src="{{ asset($event['events']->eventPictures[0]->image_path) }}"
                                                        type="video/mp4">
                                                </video>
                                            @else
                                                <img src="{{ asset($event['events']->eventPictures[0]->image_path) }}"
                                                    class="eventBgImage " alt="" srcset="">
                                            @endif
                                        </a>
                                        <div class="options">
                                            @if (Auth::id() != $event['events']->user_id)
                                                <div
                                                    class="{{ $event['Following'] == 1 ? 'darkGreenBanner' : 'greenBanner' }}  align-items-center d-flex">
                                                    <i class="fa fa-user-plus text-white">
                                                        <a href="{{ url('profile/' . $event['events']->user->id) }}">
                                                            <span
                                                                class="text-white">{{ $event['Following'] == 1 ? 'Followed' : 'Follow' }}
                                                            </span></a>

                                                    </i>
                                                </div>
                                            @endif
                                            <div class="whiteIconsBackgroundBox ">

                                                <i onclick="favroute(this) " data-id="{{ $event['events']->id }}"
                                                    class="fa fa-heart {{ $event['isFavroute'] == 1 ? 'red' : 'light-grey' }} Î "></i>
                                            </div>
                                            {{-- <div class="whiteIconsBackgroundBox mt-5 ">
                                            <i class="fa fa-flag light-grey "></i>
                                        </div> --}}
                                        </div>
                                        <div class="whiteBanner left-0  text-center align-items-center d-flex">
                                            @if ($event['events']->user->profilePicture != null)
                                                <img class="smallCircularImage mr-2 "
                                                    src="{{ url($event['events']->user->profilePicture->image) }}" />
                                                <a style="color:black"
                                                    href="{{ url('profile/' . $event['events']->user->id) }}"><span>{{ $event['events']->user->name }}</span></a>
                                            @else
                                                <img class="smallCircularImage mr-2 "
                                                    src="{{ url('assets/images/usersImages/userPlaceHolder.png') }}" />
                                                <a style="color:black"
                                                    href="{{ url('profile/' . $event['events']->user->id) }}"><span>{{ $event['events']->user->name }}</span></a>
                                            @endif

                                        </div>
                                        <div class="whiteBanner text-center align-items-center d-flex">
                                            <i class="fa fa-user-plus">
                                                <span>{{ $event['events']->user->followers->count() }}
                                                    Followers</span>
                                            </i>
                                        </div>
                                    </div>

                                    <div class="eventsSubDetails row mx-auto">
                                        <div class="col-md-7 col-sm-7 col-5">
                                            <span class="eventsTitle">{{ $event['events']->event_name }}</span>
                                        </div>
                                        <div class="col-md-5 col-sm-5 col-7">
                                            <div class="smallTextGrey d-flex justify-content-around ">
                                                <i class="fa fa-calendar nowrap ">
                                                    <span
                                                        class="text-center">{{ $event['events']->event_date }}</span>
                                                </i>
                                                &nbsp;&nbsp;
                                                <i class="fa fa-map-marker nowrap">
                                                    <span>{{ $event['km'] }} Miles away</span>
                                                </i>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="eventOptions">
                                        <div class="row mx-auto justify-content-between align-items-center ">
                                            <div id="isLiked" onclick="like(this)" data-id="{{ $event['events']->id }}"
                                                class="nowrap  col-md-3 col-sm-3 col-3 {{ $event['isLiked'] == 1 ? 'blue' : 'nothing' }}">
                                                <i class="fa fa-thumbs-up ">
                                                </i>
                                                <span id="totalLikes{{ $event['events']->id }}"
                                                    class="eventsDetailsHome  ">
                                                    {{ $event['events']->like->count() }}
                                                    Likes</span>
                                                {{-- <span class="vertical"></span> --}}
                                            </div>

                                            <a class="nowrap" style="text-decoration: none"
                                                href="{{ url('eventComment/' . $event['events']->id) }}">
                                                <div class="  col-md-3 col-sm-3 col-3  mediumTextGrey ">
                                                    <i class="fa fa-comments">
                                                    </i>
                                                    <span class="eventsDetailsHome">
                                                        {{ $event['events']->comment->count() }} Comments</span>

                                                </div>
                                                {{-- <span class="vertical"></span> --}}
                                            </a>



                                            {{-- <div class="col-md-3 col-sm-3 col-3  mediumTextGrey ">
                                            <i class="fa fa-share">
                                            </i>
                                            <span class="eventsDetailsHome"> 20 Shares</span>
                                            <span class="vertical"></span>

                                        </div> --}}
                                            <a href="{{ url('eventSnap/' . $event['events']->id) }}"
                                                class="nowrap">
                                                <div class="col-md-3 col-sm-3 col-3 mediumTextGrey">
                                                    <i class="fa fa-play">
                                                    </i>
                                                    <span class="eventsDetailsHome">
                                                        {{ $event['events']->liveFeed->count() }}
                                                        Live Snaps</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    @else
                        <h6 class="text-center mt-5">No Events Available </h6>

                    @endif




                    <!-- snaps -->
                    {{-- <div class="eventsNearYouBG">
                        <div class="eventsNearYou">
                            <img src="{{ url('assets/images/snapBg.png') }}" class="eventBgImage " alt="" srcset="">
                            <img src="{{ url('assets/images/play.png') }}" class="centerIcon">

                            <div class="whiteBanner left-0  text-center align-items-center d-flex">
                                <img class="smallCircularImage mr-2 " src="{{ url('assets/images/man.jpg') }}" />
                                <span>John Doe</span>
                            </div>

                            <div class="whiteBannerSmall text-center align-items-center d-flex">
                                <div class="iconsBackgroundBoxWhite">
                                    <img src="{{ url('assets/images/playGrey.png') }}" alt="" srcset="">
                                </div>
                            </div>

                        </div>

                        <div class="eventsSubDetails row mx-auto">
                            <div class="col-md-7 col-sm-7 col-5">
                                <span class="eventsTitle">Local Party</span>
                            </div>
                            <div class="col-md-5 col-sm-5 col-7 eventOptions">
                                <div class="smallTextGrey row">
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <i class="fa fa-calendar  ">
                                            <span>Tomorrow</span>
                                        </i>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <i class="fa fa-map-marker ">
                                            <span>5km away</span>
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <br><br>
                </div>
            </div>

            @include('front.right_side')
        </div>
    </div>
@endsection
<!-- createEventModal -->
<div class="modal  bd-example-modal-lg" id="createEventModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="modal-body">
                <div class=" row align-items-center justify-content-center text-center ">
                    <div class="col-md-3">
                        <img class="img-fluid" src="{{ url('assets/images/headerLogo.png') }}" alt="" srcset="">
                    </div>
                    <div class="col-md-7 col-sm-8">
                        <h5>Create a new event</h5>
                    </div>
                    <div class="col-md-2">
                        {{-- <img class="w-20" src="{{ url('assets/images/info.png') }}" alt="" srcset=""> --}}
                    </div>
                </div>
                <div class="row mt-4 h-100">
                    <div class="col-md-6">
                        <div class="inputFieldGreenBG d-flex ">
                            <input type="text" class="headerSearchColor ml-3" name="eventName" id="eventName"
                                placeholder="Event Name">
                        </div>
                        <div class="inputFieldGreenBG  mt-2 h-50">
                            <textarea style="margin-left: 15px;" rows="5" type="text" class=" headerSearchColor  mt-2"
                                name="eventDescription" id="eventDescription"
                                placeholder="Event Description"></textarea>
                        </div>
                        <label for="eventType" class="normal-text mt-3 mb-2">Event Type</label>
                        <select class="inputFieldGreenBG d-flex even_type" name="eventType" id="eventType">
                            <option selected disabled>Select</option>
                            @foreach ($eventTypes as $type)
                                <option value="{{ $type->type }}">{{ $type->type }}</option>
                            @endforeach

                            Î
                        </select>
                    </div>
                    <div class=" col-md-5 text-center greyBorder borderRadius10 mt-3">
                        <img id="eventPictureSrc" class="img-fluid mt-1" src="{{ url('assets/images/Frame.png') }}"
                            alt="" srcset="">
                        <h6 class="lightGreenTeal uploadCatchyText mt-4">Upload a catchy event picture or video</h6>
                        <input type="file" name="image" id="uploadEventPicture" class="d-none" />
                        <video autoplay playsinline id="eventVideoSrc" src="" class="eventBgImage"
                            style="display: none">
                            Your browser does not support HTML5 video.


                        </video>
                        <div class="progress mt-3 d-none">
                            <div class="bar"></div>
                            <div class="percent">0%</div>
                        </div>


                        <Button onclick="getImages()" id="uploadPictureBtn" class="upcoming mb-3">Upload
                            Picture/Video</Button>
                        <div class="d-flex eventPictures">

                        </div>
                    </div>



                    <input class=" event_date" v type="date" name="event_date" id="event_date" placeholder="d|m|y" />
                    <div class="d-flex w-100 align-items-center inputFieldGreenBG mt-3 ml-3 mr-3">
                        <img class="img-fluid ml-2" src="{{ asset('assets/images/loc.png') }}" alt="">
                        <input type="text" id="venue" autocomplete="off" class="ml-2" name="location"
                            placeholder="Venue">
                        {{-- <button class="loction_select"><img src="{{ asset('assets/images/loctin.png') }}" alt=""> Add
                            location from
                            map</button> --}}
                    </div>
                    <div class="d-flex w-100 align-items-center inputFieldGreenBG mt-3 ml-3 mr-3">
                        <img class="img-fluid ml-2" src="{{ url('assets/images/fil.png') }}" alt="">
                        <input class="ml-2" type="text" name="ticket_link" id="ticket_link"
                            placeholder="Ticket Link">
                        {{-- <button class="link_select"> Paste Link</button> --}}
                    </div>

                    <div class=" eventsCondition">
                        <p class="event_cont eventCond">Event Conditions</p>
                        <button onclick="eventConditions(this)" class="event_con mt-2 ml-3">Add Conditions</button>
                    </div>
                    <div class="w-100">
                        <p class="event_cont"><img src="{{ url('assets/images/icons/eyeDark.png') }}"
                                class="mr-2 ">Event privacy</p>
                        <div class=" w-100 ml-3 ">
                            <button id="publicBtn" onclick="makeEventPublic(1)" class="event_tag">Public</button>
                            <button id="privateBtn" onclick="makeEventPublic(0)" class="event_t ml-2">Private</button>

                            <span class="ml-2 mt-2" id="eventMsg" style="display: block"> This event will be
                                public.
                                Everyone on Event Spotter will be able to see this event details. </span>
                        </div>
                    </div>
                    <button class="create" id="createEventButton"> Create</button>
                    <button id="draftEvent" class="save"> Save as draft</button>

                </div>




            </div>



        </div>
    </div>
</div>
@section('script')
    <script type="text/javascript">
        var eventConditionsArray = [];
        let is_public = 1;
        var lat, lng;
        var geocoder;

        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');

        var myDate = document.querySelector('event_date');
        var today = new Date();
        $('#event_date').val(today.toISOString().substr(0, 10));


        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
        }
        //Get the latitude and the longitude;
        function successFunction(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            codeLatLng(lat, lng);
        }

        function errorFunction(error) {
            alert('Please enable location');
        }

        function initialize() {
            var places = new google.maps.places.Autocomplete(document.getElementById('venue'));
            console.log(places);
            google.maps.event.addListener(places, 'place_changed', function() {
                var place = places.getPlace();
                console.log(place);
                var address = place.formatted_address;
                lat = place.geometry.location.lat();
                lng = place.geometry.location.lng();


            });
            geocoder = new google.maps.Geocoder();
        }

        function codeLatLng(lat, lng) {
            var latlng = new google.maps.LatLng(lat, lng);
            console.log(lat + '  ' + lng);
            $.ajax({
                type: 'POST',
                url: '/save-lat-lng',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "lat": lat,
                    'lng': lng,
                }
            }).done(function(msg) {

            })
        }

        function myfunction() {
            location.replace("your_event.html")
        }

        function eventConditions(condition) {

            if (condition.innerText == 'Add Conditions') {
                var conditionText = prompt("Condition", "");
                $("<button onclick='removeConditions(this)' id=" + conditionText + " class='event_tag mt-2'>" +
                    conditionText +
                    "</button>").insertAfter(
                    '.eventCond');
                eventConditionsArray.push(conditionText);

            } else {

            }
        }

        function removeConditions(condition) {
            $('#' + condition.innerText).remove();
            eventConditionsArray = eventConditionsArray.filter(item => item !== condition.innerText)
        }

        function makeEventPublic(val) {
            is_public = val;
            if (val == 1) {
                $('#publicBtn').addClass('event_tag');
                $('#publicBtn').removeClass('event_t')
                $('#privateBtn').addClass('event_t');
                $('#privateBtn').removeClass('event_tag');
                $('#eventMsg').html(
                    'This event will be public. Everyone on Event Spotter will be able to see this event details.');

            } else {
                $('#publicBtn').addClass('event_t');
                $('#publicBtn').removeClass('event_tag');
                $('#privateBtn').addClass('event_tag');
                $('#privateBtn').removeClass('event_t');
                $('#eventMsg').html('This event can only be viewed by your followers Or people you are following.');
            }
        }


        $('#createEventButton').click(function(event) {
            event.preventDefault();
            var form_data = new FormData();
            if (eventImages1 == null) {
                showToaster('Image is required', '');
                return;
            }
            form_data.append("image", eventImages1.files[0]);
            form_data.append('event_name', $('#eventName').val());
            form_data.append('event_description', $('#eventDescription').val());
            form_data.append('event_type', $('#eventType :selected').text());
            form_data.append('location', $('#venue').val());
            form_data.append('event_date', $('#event_date').val());
            form_data.append('ticket_link', $('#ticket_link').val());
            form_data.append('conditions', eventConditionsArray);
            form_data.append('is_public', is_public);
            if (lat)
                form_data.append('lat', lat);
            if (lng)
                form_data.append('lng', lng);
            $.ajax({
                type: 'POST',
                url: '/createEvent',
                mimeType: "multipart/form-data",
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,
                beforeSend: function() {
                    // $("#uploadSnap").prop('disabled', true); //disable.
                    $('.progress').removeClass('d-none');
                    $('#uploadPictureBtn').hide();
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();

                    xhr.upload.addEventListener("progress", function(evt) {

                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);

                            var percentVal = percentComplete + '%';
                            bar.width(percentVal);
                            bar.css("background", "#314648");
                            percent.html(percentVal);

                        }
                    }, false);

                    return xhr;
                },
                error: function(res) {
                    var errors = JSON.parse(res.responseText);
                    console.log(errors);
                    if (errors.errors.event_date) {
                        showToaster('Date is not valid.', 'error');
                    } else if (errors.errors.lat) {
                        showToaster('Location is not valid.', 'error');
                    } else if (errors.errors.lng) {
                        showToaster('Location is not valid.', 'error');
                    }
                    $('#uploadPictureBtn').show();


                }
            }).done(function(msg) {
                showToaster('Your event has been created successfully', 'success');
                $('.progress').addClass('d-none');

                $('#createEventModal').modal('toggle');
                location.reload();

            })
        });

        //draft event

        $('#draftEvent').click(function(event) {
            event.preventDefault();
            var form_data = new FormData();
            if (eventImages1.files[0] != null)
                form_data.append("image", eventImages1.files[0]);
            form_data.append('event_name', $('#eventName').val());
            form_data.append('event_description', $('#eventDescription').val());
            form_data.append('event_type', $('#eventType :selected').text());
            form_data.append('location', $('#venue').val());
            form_data.append('ticket_link', $('#ticket_link').val());
            form_data.append('event_date', $('#event_date').val());
            form_data.append('conditions', eventConditionsArray);
            form_data.append('is_public', is_public);

            $.ajax({
                type: 'POST',
                url: '/draftEvent',
                mimeType: "multipart/form-data",
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data
            }).done(function(msg) {
                showToaster('Your event has been drafted', 'success');
                $('#createEventModal').modal('toggle');


            })
        });

        //upload Event Pictures & Videos

        function getImages() {
            $('#uploadEventPicture').click();
        }
        var eventImages1 = null;
        $(function() {
            $('#uploadEventPicture').change(function() {
                var input = this;
                eventImages1 = input;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" ||
                        ext == "jpg")) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#eventVideoSrc').hide();
                        $('#eventPictureSrc').attr('src', e.target.result);
                        $('#eventPictureSrc').addClass('img-fluid mb-5 mt-3');
                        $('#eventPictureSrc').show();

                    }
                    $('.uploadCatchyText').addClass('d-none');
                    reader.readAsDataURL(input.files[0]);


                } else if (input.files && input.files[0] && (ext == "mp4" || ext == "mov")) {
                    $('#eventPictureSrc').toggle();
                    var reader = new FileReader();
                    let file = input.files[0];
                    let blobURL = URL.createObjectURL(file);
                    document.querySelector("video").style.display = 'block';
                    document.querySelector("video").src = blobURL;
                    reader.onload = function(e) {
                        $('#eventVideoSrc').show();
                        // var $source = $('#eventVideoSrc');
                        // $source[0].src = URL.createObjectURL(input.files[0]);
                        // $source.parent().load();
                        $('#eventPictureSrc').hide();

                        // $('#eventPictureSrc').addClass('img-fluid mb-5 mt-3');
                    }
                    // $('.uploadCatchyText').addClass('d-none');
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('Invalid Image type');
                }
            });

        });

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

        function like(event) {
            var id = $(event).attr('data-id');
            if ($(event).hasClass('nothing')) {
                $(event).removeClass('nothing');
                $(event).addClass('blue');
            } else {
                $(event).removeClass('blue');
                $(event).addClass('nothing');
            }
            $.ajax({
                type: 'POST',
                url: '/like',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'event_id': id,
                }
            }).done(function(msg) {
                // showToaster(msg.message, 'success');
                $('#totalLikes' + id).html(msg.totalLikes + ' Likes');
                $(event).removeClass('blue');
                $(event).addClass(msg.className);

            })
        }
    </script>
@endsection
