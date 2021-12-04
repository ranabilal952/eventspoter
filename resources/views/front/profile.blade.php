@include('layouts.head')

<body>
    @include('front.header')
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-md-9 col-sm-12 col-12 mx-auto ">
                <div class="profileSection">
                    <h6 class="mb-3 medium-text ml-4">Profile</h6>
                    <div class="profileInfo  align-items-center mt-2 ml-3">
                        <div class="w-100 row justify-content-center">
                            <img class="circularImage" id="profileImage"
                                src={{ $profilePicture ? asset($profilePicture->image) : asset('assets/images/usersImages/userPlaceHolder.png') }} />
                            <input type="file" name="image" id="ownProfilePic" class="d-none" />
                            <div class="personInfo ml-3 ">
                                <span>{{ $user->name }}</span>
                                <br>
                                <span
                                    class="light-grey normal-text">{{ $address ? $address->city : 'Not-Available' }}</span>
                            </div>
                        </div>
                        <div class="personFollowersInfo  mx-auto justify-content-center align-items-center">
                            <a href="{{ url('/follower') }}">
                                <div class="grey-background pro margin-left-20 borderRadius5 text-center pl-3 pr-3">
                                    <span class="large-text">{{ $followers }}</span>
                                    <br>
                                    <span class="notifications-primary-text">Followers</span>
                                </div>
                            </a>
                            <a href="{{ url('/following') }}">
                                <div class="grey-background pro borderRadius5 margin-left-20 text-center pl-3 pr-3 ">
                                    <span class="large-text">{{ $following }}</span>
                                    <br>
                                    <span class="notifications-primary-text">Following</span>
                                </div>
                            </a>
                            <div class="grey-background pro borderRadius5  margin-left-20 text-center pl-3 pr-3">
                                <span class="large-text">{{ $totalEvents ?? '0' }}</span>
                                <br>
                                <span class="notifications-primary-text">Events</span>
                            </div>
                            @if (Auth::User()->id == $user->id)
                                <div class="w-100 text-center">
                                    <button class="logout" onclick="window.location='{{ url('/logout') }}'">
                                        <img src="{{ asset('assets/images/logout.png') }}" alt="logout" srcset="">
                                        <span class="ml-2">Logout</span>
                                    </button>
                                </div>
                            @else
                                <button class="logout" id="followBtn">
                                    <span id="isFollowing" class="followClass ml-2"> Follow</span>
                                </button>
                            @endif

                        </div>
                    </div>
                </div>
                @if (Auth::User()->id == $user->id)

                    <div class="yourEvents">
                        <div class=" align-items-center">
                            <h6 class=" medium-text ml-4 mt-2">Your Events</h6>
                            <button id="upcomingEventsBtn" class="upcomingProfile ml-3">Upcoming</button>
                            <button id="pastEventsBtn" class="pastOutlineButton proo ml-3">Past Events</button>
                            <button id="draftEventsBtn" class="pastOutlineButton pro ml-3">Drafts</button>
                        </div>

                        <div class="d-flex scroll " id="events">


                        </div>

                    </div>
                @endif
                <div class="personalDetailsBg mb-5 ">
                    <div class="ml-4 mb-5">
                        <div class="mt-3">
                            <button id="personDetailsBtn" class="upcomingProfile ml-3  medium-text">Personal
                                Details</button>
                            @if (Auth::User()->id == $user->id)
                                <button id="settingButton" onclick="openSettings()"
                                    class="pastOutlineButton pro ml-3">Settings</button>
                            @endif
                        </div>
                        <div class="w-100  justify-content-center ">
                            <div id="editSuccessMsg" class="alert alert-success w-50 mt-3 text-center d-none "
                                role="alert">
                                You can edit the details now
                            </div>
                        </div>
                        <div class="personalDetailsContent ml-3 ">
                            <label for="email" class="normal-text mt-3">Email</label>
                            <div class="inputFieldGreenBG ">
                                <input type="email" class="headerSearchColor ml-3" name="email"
                                    value={{ $user->email }} id="email" disabled style="margin-top: 10px;">
                            </div>
                            @if (Auth::User()->id == $user->id || $user->mobile_is_private == 0)
                                <label for="phoneNumber" class=" normal-text mt-3">Phone Number</label>
                                <div class="inputFieldGreenBG  ">
                                    <input type="text" class="headerSearchColor ml-3 inputDisabled" name="phoneNumber"
                                        value={{ $user->phone_number }} id="phoneNumber" disabled
                                        style="margin-top: 10px;">
                                </div>
                            @endif

                            @if (Auth::User()->id == $user->id)
                                <div class=" w-50 align-items-center mt-2">
                                    Make Private
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="makePhonePrivate"
                                            style="margin-top: 10px;">
                                        <label class="labelSwitch" for="makePhonePrivate"></label>
                                    </div>
                                </div>
                            @endif


                            <div class="">
                                <div class="field">
                                    <label for="address" class="normal-text mt-3">Address</label>
                                    <div class="inputFieldGreenBG  ">
                                        <input type="text" class="headerSearchColor ml-3 inputDisabled" name="address"
                                            value={{ $address ? $address->address : 'Not-Available' }} id="address"
                                            disabled style="margin-top: 10px;">
                                    </div>
                                </div>
                                <div class="field ">
                                    <label for="city" class="normal-text mt-3">City</label>
                                    <div class="smallInputFieldGreenBG  ">
                                        <input type="text" class="headerSearchColor ml-3 inputDisabled" name="city"
                                            value={{ $address ? $address->city : 'Not-Available' }} id="city"
                                            disabled style="margin-top: 10px;">
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="country" class="normal-text mt-3">Country</label>
                                    <div class="smallInputFieldGreenBG  ">
                                        <input type="text" class="headerSearchColor ml-3 inputDisabled" name="country"
                                            value={{ $address ? $address->country : 'Not-Available' }} id="country"
                                            disabled style="margin-top: 10px;">
                                    </div>
                                </div>
                            </div>
                            @if (Auth::User()->id == $user->id)
                                <Button id="edit" class="upcoming mt-5 mb-5">
                                    Edit Details
                                </Button>
                            @endif

                            <Button id="saveBtn" class="upcoming mt-5 mb-5 d-none">
                                Save Details
                            </Button>
                        </div>

                        {{-- settingContent --}}
                        @if (Auth::User()->id == $user->id)
                            <div class="settingContent ml-3 mt-3 " style="display: none">
                                @if (Auth::User()->id == $user->id)
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class=" w-50  align-items-center mt-2">
                                                Use Your Location
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="useYourLocation">
                                                    <label class="labelSwitch" for="useYourLocation"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class=" w-50 align-items-center mt-2">
                                                Allow Direct Message
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="allowDirectMessage">
                                                    <label class="labelSwitch" for="allowDirectMessage"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2"></div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-5">
                                            <div class=" w-50 align-items-center mt-2">
                                                Make your profile private
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="makeProfilePrivate">
                                                    <label class="labelSwitch" for="makeProfilePrivate"></label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                @endif
                                <Button id="saveBtn" class="upcoming mt-5 mb-5 d-none">
                                    Save Details
                                </Button>
                            </div>
                        @endif
                    </div>
                </div>


            </div>
            @include('front.right_side')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/dist/jquery.toast.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $("#upcomingEventsBtn").click();
        });
        var user = {!! json_encode($user->toArray()) !!};
        if (user.mobile_is_private == 1)
            $('#makePhonePrivate').prop("checked", true);
        else
            $('#makePhonePrivate').prop("checked", false);

        if (user.use_location == '1')
            $('#useYourLocation').prop("checked", true);
        else
            $('#useYourLocation').prop("checked", false);

        if (user.allow_direct_message == '1')
            $('#allowDirectMessage').prop("checked", true);
        else
            $('#allowDirectMessage').prop("checked", false);

        if (user.profile_private == '1')
            $('#makeProfilePrivate').prop("checked", true);
        else
            $('#makeProfilePrivate').prop("checked", false);





        // var isFollowing = {!! json_encode($isFollowing) !!};
        var isFollowing = {!! json_encode($isFollowing ? $isFollowing->toArray() : null) !!};
        if (isFollowing != null) {
            if (isFollowing.is_accepted == true)
                $('#isFollowing').html('Un-Follow');
            else
                $('#isFollowing').html('Pending');

        }

        $("#edit").click(function(event) {


            event.preventDefault();
            $(this).hide();
            $('#saveBtn').removeClass('d-none');
            $('#editSuccessMsg').removeClass('d-none');


            $('.inputDisabled').prop("disabled", false); // Element(s) are now enabled.
        });

        $(function() {
            $('#ownProfilePic').change(function() {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" ||
                        ext == "jpg")) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#profileImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                    var form_data = new FormData();
                    var property = document.getElementById('ownProfilePic').files[0];
                    var form_data = new FormData();
                    form_data.append("image", property);
                    $.ajax({
                        type: 'POST',
                        url: '/update-profile-picture',
                        mimeType: "multipart/form-data",
                        data: form_data,
                        processData: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: form_data
                    }).done(function() {
                        showToaster('Uploaded Successfully', 'success');
                    })
                } else {
                    alert('Invalid Image type');
                }
            });

        });

        $('#profileImage').click(function(event) {
            var currUser = {!! auth()->user()->toJson() !!};
            if (currUser.id == user.id)
                $('#ownProfilePic').click();
        });

        $('#saveBtn').click(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/save-address',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "address": $('#address').val(),
                    'city': $('#city').val(),
                    'country': $('#country').val(),
                }
            }).done(function(msg) {
                $('.inputDisabled').prop("disabled", true); // Element(s) are now enabled.
                $('#editSuccessMsg').html('Information has been updated successfully');
                $('#saveBtn').addClass('d-none');
                $('#edit').toggle();
                $('#editSuccessMsg').addClass('d-none');
                showToaster('Information has been updated successfully', 'success');
            })
        });

        $('#followBtn').click(function(event) {
            event.preventDefault();
            $.ajax({
                    type: 'POST',
                    url: '/following',
                    async: true,

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "following_id": user.id,
                    },
                    success: function(response) {
                        showToaster(response.message, 'success');
                        $('.followClass').html(response.ButtonText);
                    }
                })
                .done(function() {

                })
        });
        $('#makePhonePrivate').change(function() {
            $.ajax({
                    type: 'POST',
                    url: '/makeNoPrivate',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "isPrivate": this.checked ? 1 : 0,
                    },
                    success: function(response) {
                        showToaster(response.message, 'success');
                    }
                })
                .done(function() {

                })
        });

        //useYourLocation

        $('#useYourLocation').change(function() {
            $.ajax({
                    type: 'POST',
                    url: '/useLocation',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "use_location": this.checked ? '1' : '0',
                    },
                    success: function(response) {
                        showToaster(response.message, 'success');
                    }
                })
                .done(function() {

                })
        });

        //allowDirectMsg
        $('#allowDirectMessage').change(function() {
            $.ajax({
                    type: 'POST',
                    url: '/allowDirectMessage',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "allow_direct_message": this.checked ? '1' : '0',
                    },
                    success: function(response) {
                        showToaster(response.message, 'success');
                    }
                })
                .done(function() {

                })
        });

        //makeProfilePrivate
        $('#makeProfilePrivate').change(function() {
            $.ajax({
                    type: 'POST',
                    url: '/makeProfilePrivate',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "profile_private": this.checked ? '1' : '0',
                    },
                    success: function(response) {
                        showToaster(response.message, 'success');
                    }
                })
                .done(function() {

                })
        });


        //UPCOMING EVENTS BUTTON
        $('#upcomingEventsBtn').click(function(event) {
            event.preventDefault();
            $(this).addClass('upcomingProfile');
            $(this).removeClass('pastOutlineButton');
            $('#pastEventsBtn').addClass('pastOutlineButton');
            $('#pastEventsBtn').removeClass('upcomingProfile');
            $('#draftEventsBtn').removeClass('upcomingProfile');
            $('#draftEventsBtn').addClass('pastOutlineButton');
            $.ajax({
                type: 'GET',
                url: '/getUpcomingEvents',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response.data);
                    $('#events').html('');
                    if (response.data.length > 0) {
                        response.data.forEach(function(event) {

                            var img = event.events.event_pictures[0]
                                .image_path.split('.').pop() == 'mp4' || event.events
                                .event_pictures[0]
                                .image_path.split('.').pop() == 'mov' ?
                                '{{ asset('download.png') }}' :
                                window.location.origin + '/' + event.events.event_pictures[0]
                                .image_path;
                            var url = "{{ url('eventDetails') }}" + "/" + event.events.id;


                            $('#events').append("<a href=" + url +
                                "> <div class='eventsCard'>" +
                                "<div class ='mx-auto d-flex  align-items-center justify-content-center'> " +
                                "<img class='profileEvents' style='border-radius:10px' src=" +
                                img + " >" +
                                "<div class ='ml-3'>" +
                                "<h6 class='eventsTitleProfile'>" + event.events
                                .event_name +
                                "</h6>" +
                                "<img class ='fav_title' src='{{ asset('assets/images/date.png') }}'>" +
                                "<span class='smallTextGrey'> " + event.events.event_date +
                                "</span>" +
                                "<br>" +
                                "<image class='fav_title' src ='{{ asset('assets/images/location.png') }}'>" +
                                "<span class='smallTextGrey'> " + event.km +
                                " Miles away</span> " +
                                "</div>" +
                                "</div>" +
                                "</div></a>"
                            );

                        });
                    } else {

                        $('#events').append(
                            "<h6 class='eventsCard text-center' style='margin:0 auto;margin-top:20px;margin-bottom:20px'>No Upcoming Events </h6>"
                        );
                    }
                }
            })

        });
        //PAST EVENTS BUTTON
        $('#pastEventsBtn').click(function(event) {

            event.preventDefault();
            $(this).addClass('upcomingProfile');
            $(this).removeClass('pastOutlineButton');
            $('#upcomingEventsBtn').removeClass('upcomingProfile');
            $('#upcomingEventsBtn').addClass('pastOutlineButton');
            $('#draftEventsBtn').removeClass('upcomingProfile');
            $('#draftEventsBtn').addClass('pastOutlineButton');


            $.ajax({
                    type: 'GET',
                    url: '/getPastEvents',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response.data);
                        $('#events').html('');

                        if (response.data.length > 0) {
                            response.data.forEach(function(event) {
                                var img = event.events?.event_pictures[0]
                                    .image_path.split('.').pop() == 'mp4' || event.events
                                    .event_pictures[0]
                                    .image_path.split('.').pop() == 'mov' ?
                                    '{{ asset('download.png') }}' :
                                    window.location.origin + '/' + event.events.event_pictures[0]
                                    .image_path;
                                var url = "{{ url('eventDetails') }}" + "/" + event.events.id;
                                $('#events').append("<a href=" + url +
                                    "> <div class='eventsCard'>" +
                                    "<div class ='mx-auto d-flex  align-items-center justify-content-center'> " +
                                    "<img class='profileEvents' style='border-radius:10px' src=" +
                                    img + " >" +
                                    "<div class ='ml-3'>" +
                                    "<h6 class='eventsTitleProfile'>" + event.events
                                    .event_name +
                                    "</h6>" +
                                    "<img class ='fav_title' src='{{ asset('assets/images/date.png') }}'>" +
                                    "<span class='smallTextGrey'> " + event.events.event_date +
                                    "</span>" +
                                    "<br>" +
                                    "<image class='fav_title' src ='{{ asset('assets/images/location.png') }}'>" +
                                    "<span class='smallTextGrey'> " + event.km +
                                    " Miles away</span> " +
                                    "</div>" +
                                    "</div>" +
                                    "</div></a>"
                                );

                            });
                        } else {
                            $('#events').append(
                                "<h6 class='eventsCard text-center' style='margin:0 auto;margin-top:20px;margin-bottom:20px'>No Past Events </h6>"
                            );

                        }
                    }
                })
                .done(function() {

                })
        });
        //DRAFT EVENTS BUTTON
        $('#draftEventsBtn').click(function(event) {
            event.preventDefault();
            $(this).addClass('upcomingProfile');
            $(this).removeClass('pastOutlineButton');
            $('#upcomingEventsBtn').removeClass('upcomingProfile');
            $('#upcomingEventsBtn').addClass('pastOutlineButton');
            $('#pastEventsBtn').addClass('pastOutlineButton');
            $('#pastEventsBtn').removeClass('upcomingProfile');

            $.ajax({
                    type: 'GET',
                    url: '/getDraftEvents',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response.data);
                        $('#events').html('');

                        if (response.data.length > 0) {
                            response.data.forEach(function(event) {
                                var img = event.events?.event_pictures[0]
                                    .image_path.split('.').pop() == 'mp4' || event.events
                                    ?.event_pictures[0]
                                    .image_path.split('.').pop() == 'mov' ?
                                    '{{ asset('download.png') }}' :
                                    window.location.origin + '/' + event.events?.event_pictures[0]
                                    .image_path;

                                var url = "{{ url('eventDetails') }}" + "/" + event.events?.id;

                                $('#events').append("<a href=" + url +
                                    "> <div class='eventsCard'>" +
                                    "<div class ='mx-auto d-flex  align-items-center justify-content-center'> " +
                                    "<img class='profileEvents' style='border-radius:10px' src=" +
                                    img + " >" +
                                    "<div class ='ml-3'>" +
                                    "<h6 class='eventsTitleProfile'>" + event.events
                                    .event_name +
                                    "</h6>" +
                                    "<img class ='fav_title' src='{{ asset('assets/images/date.png') }}'>" +
                                    "<span class='smallTextGrey'> " + event.events.event_date +
                                    "</span>" +
                                    "<br>" +
                                    "<image class='fav_title' src ='{{ asset('assets/images/location.png') }}'>" +
                                    "<span class='smallTextGrey'> " + event.km +
                                    " Miles away</span> " +
                                    "</div>" +
                                    "</div>" +
                                    "</div></a>"
                                );


                            });
                        } else {
                            $('#events').append(
                                "<h6 class='eventsCard text-center' style='margin:0 auto;margin-top:20px;margin-bottom:20px'>No Drafted Events Events </h6>"
                            );

                        }
                    }
                })
                .done(function() {

                })
        });

        //setting oopen 

        $('#settingButton').click(function(event) {
            event.preventDefault();
            $(this).addClass('upcomingProfile');
            $(this).removeClass('pastOutlineButton');
            $('#personDetailsBtn').removeClass('upcomingProfile');
            $('#personDetailsBtn').addClass('pastOutlineButton');
            $('.personalDetailsContent').hide();
            $('.settingContent').show();

        });

        $('#personDetailsBtn').click(function(event) {
            event.preventDefault();
            $('#settingButton').addClass('pastOutlineButton');
            $('#settingButton').removeClass('upcomingProfile');
            $('#personDetailsBtn').removeClass('pastOutlineButton');
            $('#personDetailsBtn').addClass('upcomingProfile');
            $('.personalDetailsContent').show()
            $('.settingContent').hide();
        });
    </script>


</body>

</html>
