@include('layouts.head')

<body>

    @include('front.header')
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-9 col-sm-12 col-12">
                <div class="notification">
                    <div class="not_title">Notifications </div>
                    <div class="row notifiy">
                        <div class="col-2">
                            <img class="notify_prfile" src="assets/images/follower.png" alt="">
                        </div>
                        <div class="col-8">
                            <p class="notify_description"><span class="notify_title">Joana Karg</span> started following
                                you</p>
                        </div>
                        <div class="col-2">
                            <p class="notify_time">3s ago</p>
                        </div>
                    </div>
                    <div class="last_notify"></div>
                    <div class="row notifiy">
                        <div class="col-2">
                            <img class="notify_prfile" src="assets/images/Ellipse 5.png" alt="">
                        </div>
                        <div class="col-8">
                            <p class="notify_description"><span class="notify_title">Joana Karg</span> started following
                                you</p>
                        </div>
                        <div class="col-2">
                            <p class="notify_time">3s ago</p>
                        </div>
                    </div>
                    <div class="last_notify"></div>
                    <div class="row notifiy">
                        <div class="col-2">
                            <img class="notify_prfile" src="assets/images/Ellipse 4.png" alt="">
                        </div>
                        <div class="col-8">
                            <p class="notify_description"><span class="notify_title">Joana Karg</span> started following
                                you</p>
                        </div>
                        <div class="col-2">
                            <p class="notify_time">3s ago</p>
                        </div>
                    </div>
                    <div class="last_notify"></div>
                    <div class="row notifiy">
                        <div class="col-2">
                            <img class="notify_prfile" src="assets/images/follower.png" alt="">
                        </div>
                        <div class="col-8">
                            <p class="notify_description"><span class="notify_title">Joana Karg</span> started following
                                you</p>
                        </div>
                        <div class="col-2">
                            <p class="notify_time">3s ago</p>
                        </div>
                    </div>
                    <div class="last_notify"></div>
                </div>
            </div>
            {{-- <div class="col-md-12 col-sm-12 col-12">
                <div class="notification">
                    <div class="not_title">Notifications </div>
                    @if (count($notifications) > 0)
                        @foreach ($notifications as $item)
                            @php
                                $url = $item->id . '/' . $item->route_name;
                            @endphp

                            <div class="row notifiy align-items-center " style="display: flex; justify-content:space-evenly;">
                                <a href="{{ url('profile/'.$item->user->id) }}">
                                    <div class="col-lg-2 col-sm-4 ">
                                        @if ($item->user->profilePicture != null)
                                            <img src="{{ $item->user->profilePicture->image }}"
                                                class="notify_prfile circularImage">
                                        @else
                                            <img src="{{ asset('assets/images/usersImages/userPlaceHolder.png') }}"
                                                class="notify_prfile circularImage" alt="" srcset="">
                                        @endif
                                    </div>
                                </a>

                              
                                <div class="col-6 col-sm-4">

                                    <p class="notify_description">{{ $item->message }}</p>
                                </div>
                                <div class="col-2 col-sm-4">
                                    <p class="notify_time">{{ $item->created_at->diffForHumans() }}</p>
                                </div>
                                
                            </div>

                            <div class="last_notify"></div>
                        @endforeach
                    @else

                        <div class="text-center d-flex justify-content-center align-items-center ">
                            No Notifications Available
                        </div>

                    @endif



                </div>
            </div> --}}
            {{-- <div class="col-md-3">
                <div class="notifications mx-auto">
                    <p class="margin-left-20">Live Notifications</p>
                    <div class="d-flex align-items-center margin-5 side">
                        <div class="iconsBackgroundBox">
                            <img src="assets/images/video.png" alt="">
                        </div>
                        <span class=" ml-2  notifications-primary-text"> John Doe started streaming of their
                            event</span>
                        <span class="agoColor">3s ago</span>
                    </div>

                    <hr>
                    <div class="d-flex align-items-center margin-5 side">
                        <div class="iconsBackgroundBox">
                            <img src="assets/images/camera_enhance.png" alt="">
                        </div>
                        <span class=" ml-2  notifications-primary-text"> John Doe started streaming of their
                            event</span>
                        <span class="agoColor">3s ago</span>
                    </div>

                    <hr>
                    <div class="d-flex align-items-center margin-5 side">
                        <div class="iconsBackgroundBox">
                            <img src="assets/images/video.png" alt="">
                        </div>
                        <span class=" ml-2  notifications-primary-text"> John Doe started streaming of their
                            event</span>
                        <span class="agoColor">3s ago</span>
                    </div>

                    <hr>
                    <div class="d-flex align-items-center margin-5 side">
                        <div class="iconsBackgroundBox">
                            <img src="assets/images/camera_enhance.png" alt="">
                        </div>
                        <span class=" ml-2  notifications-primary-text"> John Doe started streaming of their
                            event</span>
                        <span class="agoColor">3s ago</span>
                    </div>
                    <hr>
                </div>
            </div> --}}
        </div>
    </div>
</body>

</html>
