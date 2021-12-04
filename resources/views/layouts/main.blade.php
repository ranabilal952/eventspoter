<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('assets/style/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/libraries/css/bootstrap.min.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('css/chat.css') }}" /> --}}

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/dist/jquery.toast.min.css') }}">
    <script src="{{ asset('assets/libraries/js/fontawesome.js') }}"></script>
    <script src="{{ asset('assets/dist/customToast.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZTqBDEFeniyz9QukE0gu4yQ5g2mt7rm0&libraries=places&callback=initialize"
        async defer></script>
    <script>
        var user = {!! json_encode((array) auth()->user()) !!};
        var base_url = '{{ url('/') }}';
    </script>

</head>

<body>
    @php
        $userWithImage = Auth::user()->load('profilePicture');
        $notifications = App\Models\Notifications::where('user_id', $userWithImage->id)
            ->where('is_read', '!=', 1)
            ->get();
    @endphp
    <div class="header">
        <div class="row">
            <div class="col-md-2 ">
                <div class="headerlogo">
                    <a href="{{ url('/') }}"><img class="img-fluid"
                            src="{{ url('assets/images/headerLogo.png') }}" alt=""></a>
                </div>
            </div>

            <div class=" col-md-7 ">
                <div class="d-flex headerSearchBColor ">
                    <img class="img-fluid ml-2 mr-2 " src="{{ url('assets/images/icons/searechIcon.png') }}"
                        alt="search">
                    <input class="" id="search" name="search" type="text" placeholder="Search">

                </div>
                <div class="searchResults"></div>

            </div>

            <div class="col-md-2 topMargin ">
                <div class="row align-items-center tools">
                    <div class="col-md-4 col-sm-4 col-4">
                        <div class="iconsBackgroundBox ">
                            <a href="{{ url('notifications') }}"><img class="img-fluid "
                                    src="{{ asset('assets/images/icons/notificationBellIcon.png') }}" /></a>
                            @if (count($notifications) > 0)
                                <div class="notificationDot"></div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-4 col-sm-4 col-4">
                        <div class="iconsBackgroundBox ">
                            <a href="{{ url('chat-home') }}"><img class="img-fluid "
                                    src="{{ asset('assets/images/emailDark.png') }}" /></a>
                            <div id="chatNotificationDot" class="notificationDot d-none"></div>
                        </div>

                    </div>
                    <div class="col-md-4 col-sm-4 col-4">
                        @if ($userWithImage->profilePicture != null)
                            <a href="{{ url('/profile') }}"> <img class="circularImage"
                                    src="{{ asset($userWithImage->profilePicture->image) }}" /></a>
                        @else
                            <a href="{{ url('/profile') }}"> <img class="circularImage"
                                    src="{{ url('assets/images/usersImages/userPlaceHolder.png') }}" /></a>

                        @endif
                        <div class="activeDot"></div>
                    </div>
                </div>
            </div>

        </div>
        <div style="text-align:center;"><img id="loading" style="display: none" src="{{ asset('loader.gif') }}"
                alt="" /></div>

    </div>
    @yield('content')
    <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
    <input type="hidden" id="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}" />
    <input type="hidden" id="pusher_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}" />

    <audio id="chat-alert-sound-home" style="display: none">
        <source src="{{ asset('sound/facebook_chat.mp3') }}" />
    </audio>
    <
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var text = $('#search').val();
                if (text == '')
                    $('.searchResults').addClass('d-none');
                else
                    $('.searchResults').removeClass('d-none');
                if (text.length >= 3) {
                    $.ajax({
                        type: "GET",
                        url: '/search',
                        data: {
                            text: text,
                        },
                        success: function(data) {
                            $('.searchResults').html("");
                            if (data[0].profile_picture !== null)
                                var img =
                                    "<img class='circularImage pic mr-3' src=" + data[0]
                                    .profile_picture.image + " />"
                            else
                                var img =
                                    "<img class='circularImage pic mr-3 mb-3' src='{{ asset('assets/images/usersImages/userPlaceHolder.png') }}' />"
                            if (data.length == 0)
                                $('.searchResults').append(
                                    '<div class="w-100 justify-content-center " style="background:white;padding:20px">No Result Found</div>'
                                );
                            $.each(data, function(key, value) {
                                var url = "{{ url('profile') }}" + "/" + value.id;

                                $('.searchResults').append(
                                    '<a class="aWithoutDec" href="' + url +
                                    '"> <div class="w-100  justify-content-center " style="background:white">' +
                                    img + value
                                    .name + '</a></div> ');
                            })
                        }
                    }).done(function() {})
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous">
    </script>

    <script src="{{ asset('assets/dist/jquery.toast.min.js') }}"></script>
    @yield('script')
</body>

</html>
