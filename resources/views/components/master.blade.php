<!doctype html>
@php
    $lang = str_replace('_', '-', app()->getLocale());
@endphp
<html lang="{{ $lang }}" dir="{{ $lang == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}

    <script src="{{ asset('js/app.js') }}" ></script>
    {{-- <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> --}}
    {{-- <script src="http://podio.github.io/jquery-mentions-input/lib/jquery.elastic.js"></script> --}}
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('js/ajax.js') }}" ></script>

    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    
    @if ($lang == 'ar')
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
        integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
        <style>
            input[type="text"]::-webkit-input-placeholder {text-align: right}
            textarea::-webkit-input-placeholder {text-align: right}
            @media (max-width: 767.98px) {
                .btn {padding: 0.25rem 0.5rem;font-size: 0.9rem;line-height: 1.5;border-radius: 0.2rem;}
            }
            body{font-size: 0.9rem;line-height: 1.6;}
        </style>
    @endif

    <style>
        @media (max-width: 767.98px) {.btn {font-size: 0.9rem}}
        @media (min-width: 1200px) {.nav-bg {background-color:#cfeaf5!important}}
        textarea{resize: none}
        .style{width:calc(0.5vw + 70px);height:calc(0.1vw + 30px);font-size:0.8rem}
        .style-b{width:calc(1.5vw + 70px);height:calc(0.8vw + 30px);font-size:0.9rem}
    </style>
</head>
<body>
    <div id="app">    
        {{ $slot }}
    </div>
    @if (Auth::check())
        <script>
            var userId = {{current_user()->id}}
        </script>
    @endif
<script>

// Pusher.logToConsole = true;

// var pusher = new Pusher('1853c172efa24b620d3e', {encrypted: false});

// var channel = pusher.subscribe('like-channel');

// channel.bind('App\\Events\\LikeEvent', function (data) {

    // var notificationsCountElem = $(`*[data-count='${data.user_id}']`);
    // notificationsCountElem.text(data.count);
    // notificationsCountElem.text() == 0 ? '' :  notificationsCountElem.show();

// });


// Echo.channel(`like-channel`)
// .listen('LikeEvent', function (data) {
//         console.log(data);
//         var notificationsCountElem = $(`*[data-count='${data.user_id}']`);
//         notificationsCountElem.text(data.count);
//         notificationsCountElem.text() == 0 ? '' :  notificationsCountElem.show();
//     });

Echo.private('App.Models.User.' + userId)
.notification(function (data) {
    console.log(data);
    document.querySelectorAll(`[data-count="${data.user_id}"]`).forEach(function (el) {
        el.innerHTML = data.count;
        el.innerHTML == 0 ? '' : el.style.display = "inline-block";
    });

    var toast = `
            <div class="toast bg-dark" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header">
                    <strong class="mr-auto">Twitter</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body text-light">        
                <span><strong>${data.name}</strong> Liked Your Tweet</span>
                </div>
            </div>    
    `;

    $('.toasts').append(toast).children().remove('.hide');
    $('.toasts .toast').toast('show');

});

</script>



<script src="https://www.gstatic.com/firebasejs/6.3.4/firebase.js"></script>
<script>
    $(document).ready(function(){
        const config = {
            apiKey: "AIzaSyA1z-mjlbZPXCSkXJqmlO-9QQo_MW_V2S0",
            authDomain: "laravel1-7de84.firebaseapp.com",
            databaseURL: "https://laravel1-7de84.firebaseio.com",
            projectId: "laravel1-7de84",
            storageBucket: "laravel1-7de84.appspot.com",
            messagingSenderId: "906989839223",
            appId: "1:906989839223:web:29b77267b4defd4d553772",
            measurementId: "G-HWSMX0K0SP"
        };
        firebase.initializeApp(config);
        const messaging = firebase.messaging();
        
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ URL::to('/save-device-token') }}',
                    type: 'POST',
                    data: {
                        user_id: {{ Auth::id() ?? '' }},
                        fcm_token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        console.log(response)
                    },
                    error: function (err) {
                        console.log(" Can't do because: " + err);
                    },
                });
            })
            .catch(function (err) {
                console.log("Unable to get permission to notify.", err);
            });
    
        messaging.onMessage(function(payload) {
            const noteTitle = payload.notification.title;
            const noteOptions = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
console.log('ssssssssssssssssssssssssssssssss');
            new Notification(noteTitle, noteOptions);
        });
    });
</script>










</body>
</html>