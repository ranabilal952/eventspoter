@extends('layouts.main')
@section('title', 'Event Details')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="eventsNearYouSection ">
                    <div class="eventsNearYouBG">
                        <div class="eventsNearYou">

                            @if (count($eventDetails['event']->eventPictures) > 0)
                                @if (Str::substr($eventDetails['event']->eventPictures[0]->image_path, -3) == 'mp4' || Str::substr($eventDetails['event']->eventPictures[0]->image_path, -3) == 'mov')
                                    <video class="eventBgImage mr-3"
                                        src="{{ asset($eventDetails['event']->eventPictures[0]->image_path) }}" controls>
                                        <source src="{{ asset($eventDetails['event']->eventPictures[0]->image_path) }}"
                                            type="video/mp4">
                                    </video>
                                @else
                                    <img src="{{ asset($eventDetails['event']->eventPictures[0]->image_path) }}"
                                        class="eventBgImage " height="100" width="100" alt="" srcset="">
                                @endif
                            @else
                                <img src="{{ asset('placeholder.jpg') }}" class="eventBgImage " alt="" srcset="">
                            @endif

                            <div class="options">
                                <div
                                    class="{{ $eventDetails['Following'] == 1 ? 'darkGreenBanner' : 'greenBanner' }}   align-items-center d-flex">
                                    <i class="fa fa-user-plus text-white">
                                        <span class="text-white">Followed</span>
                                    </i>
                                </div>
                                {{-- <div class="whiteIconsBackgroundBox ">
                                    <i class="fa fa-heart red "></i>
                                </div> --}}
                                {{-- <div class="whiteIconsBackgroundBox mt-5 ">
                                    <i class="fa fa-flag light-grey "></i>
                                </div> --}}
                            </div>
                            <a href="{{ url('profile') . '/' . $eventDetails['event']->user_id }}">
                                <div class="whiteBanner left-0  text-center align-items-center d-flex">
                                    @if ($eventDetails['event']->user->profilePicture != null)
                                        <img class="smallCircularImage mr-2 "
                                            src="{{ url($eventDetails['event']->user->profilePicture->image) }}" />
                                    @else
                                        <img class="smallCircularImage mr-2 "
                                            src="{{ url('assets/images/usersImages/userPlaceHolder.png') }}" />
                                    @endif
                                    <span>{{ $eventDetails['event']->user->name }}</span>
                                </div>
                            </a>
                            <div class="whiteBanner text-center align-items-center d-flex">
                                <i class="fa fa-user-plus">
                                    <span>{{ $eventDetails['event']->user->followers->count() }} Followers</span>
                                </i>
                            </div>
                        </div>

                        <div class="eventsSubDetails row mx-auto">
                            <div class="col-md-7 col-sm-7 col-5">
                                <span class="eventsTitle">{{ $eventDetails['event']->event_name }}</span>
                            </div>
                            <div class="col-md-5 col-sm-5 col-7">
                                <div class="smallTextGrey row">
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <i class="fa fa-calendar  ">
                                            <span>{{ $eventDetails['event']->created_at->diffForHumans() }}</span>
                                        </i>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <i class="fa fa-map-marker ">
                                            <span>{{ $eventDetails['km'] }} Miles away</span>
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="eventOptions ">
                            <div class="row mx-auto justify-content-between">
                                <div id="isLiked" onclick="like(this)" data-id="{{ $eventDetails['event']->id }}"
                                    class="nowrap  col-md-3 col-sm-3 col-3 {{ $eventDetails['isLiked'] == 1 ? 'blue' : 'nothing' }} ">
                                    <i class="fa fa-thumbs-up ">
                                    </i>
                                    <span id="totalLikes{{ $eventDetails['event']->id }}" class="eventsDetailsHome  ">
                                        {{ $eventDetails['event']->like->count() }}
                                        Likes</span>
                                    {{-- <span class="vertical"></span> --}}
                                </div>
                                <a class="nowrap" style="text-decoration: none"
                                    href="{{ url('eventComment/' . $eventDetails['event']->id) }}">
                                    <div class="col-md-3 col-sm-3 col-3  mediumTextGrey ">
                                        <i class="fa fa-comments">
                                        </i>
                                        <span class="eventsDetailsHome">
                                            {{ $eventDetails['event']->comment->count() }}
                                            Comments</span>
                                        {{-- <span class="vertical"></span> --}}
                                    </div>
                                </a>
                                {{-- <div class="col-md-3 col-sm-3 col-3  mediumTextGrey ">
                                    <i class="fa fa-share">
                                    </i>
                                    <span class="eventsDetailsHome"> 20 Shares</span>
                                    <span class="vertical"></span>

                                </div> --}}
                                <a href="{{ url('eventSnap/' . $eventDetails['event']->id) }}" class="nowrap">
                                    <div class="col-md-3 col-sm-3 col-3 mediumTextGrey">
                                        <i class="fa fa-play ">
                                        </i>
                                        <span class="eventsDetailsHome">
                                            {{ $eventDetails['event']->livefeed->count() }}
                                            Live Snaps</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="event_comment">
                    <div class="padding16">Details
                        <p class="event_desc"> {{ $eventDetails['event']->event_description }}</p>

                    </div>
                    @if ($eventDetails['event']->ticket_link != null)
                        <div class="padding16">
                            Ticket Link
                            <br>
                            <a class="event_desc" href="{{ $eventDetails['event']->ticket_link }}">
                                {{ $eventDetails['event']->ticket_link }}
                            </a>
                        </div>
                    @endif
                    @php
                        $conditionsArr = $eventDetails['event']->conditions;
                    @endphp
                    @if (count($conditionsArr) > 0 || !empty($conditionsArr))
                        <div class="padding16">Conditions </div>
                        <div class="con_tag">
                            @foreach ($conditionsArr as $condition)
                                <button class="condition_tag"
                                    style=" overflow: hidden; text-overflow: ellipsis;">{{ $condition }}</button>
                            @endforeach
                        </div>
                    @endif


                    <br><br>
                    <div class="location_title">Location </div>
                    <p class="event_desc"> {{ $eventDetails['event']->location }}</p>
                    {{-- <img class="map" src="{{asset('assets/images/map.png')}}" alt=""> --}}
                    <div id="map"></div>

                    {{-- <button class="map_button">Buy Ticket</button> --}}
                    @if ($eventDetails['event']->user_id == Auth::id())
                        <button onclick="deleteEvent(this)" data-id="{{ $eventDetails['event']->id }}" id="deleteEvent"
                            class="map_button mb-5" style="background: rgb(148, 0, 0);border:none;">Delete
                            Event</button>

                    @endif



                </div>
            </div>

            <br>

            @include('front.right_side')

        </div>
    </div>
@endsection

@section('script')
    <script>
        function like(event) {
            var id = $(event).attr('data-id');
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
                showToaster(msg.message, 'success');
                $('#totalLikes' + id).html(msg.totalLikes + ' Likes');
                $(event).removeClass('blue');
                $(event).addClass(msg.className);

            })
        }
        var event = {!! json_encode($eventDetails['event']->toArray()) !!};

        function initialize() {
            var myLatlng = new google.maps.LatLng(event.lat, event.lng);
            var myOptions = {
                zoom: 16,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(document.getElementById("map"), myOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: "Fast marker"
            });

            marker['infowindow'] = new google.maps.InfoWindow({
                content: event.location
            });

            google.maps.event.addListener(marker, 'mouseover', function() {
                this['infowindow'].open(map, this);
            });
        }

        function deleteEvent(event) {
            var id = $(event).attr('data-id');
            $.ajax({
                type: 'POST',
                url: '/deleteEvent',
                beforeSend: function() {
                    $('#loading').show();
                    $('#deleteEvent').html('Deleting');
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'event_id': id,
                }
            }).done(function(msg) {
                showToaster(msg.message, 'success');
                $('#loading').hide();
                window.location = '/';


            })

        }
    </script>
@endsection
