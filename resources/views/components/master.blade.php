<!doctype html>
@php
    $lang = str_replace('_', '-', app()->getLocale())
@endphp
<html lang="{{ $lang }}" dir="{{ $lang == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}

    <script src="{{ asset('js/app.js') }}" ></script>
    {{-- <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> --}}
    {{-- <script src="http://podio.github.io/jquery-mentions-input/lib/jquery.elastic.js"></script> --}}
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<script>

        $(function () {
        $('[data-toggle="tooltip"]').tooltip();

    })

    $(document).ready(function () {        
        $('ul.pagination').hide();
        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<div class="text-center mt-5"><div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div></div>',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
        });
    
    
        });
        
    // Ajax
// function like(myForm, liked) {
// $(document).on('submit', myForm, function (event) { 
// event.preventDefault();
// var id = $(this).data('id');
// var route = $(this).attr('action');
// axios({
//     url         :       route,
//     method        :       "POST",
//     data        :       {"_token": "{{ csrf_token() }}", "liked": liked},
//     }).then(function (response) {
//         $('#l-' + id).html(response.data.html);
//     });
// });
// }

function like(myForm, liked) {
$(document).on('submit', myForm, function (event) { 
event.preventDefault();
var id = $(this).data('id');
var route = $(this).attr('action');
$.ajax({
    url         :       route,
    type        :       "POST",
    data        :       {"_token": "{{ csrf_token() }}", "liked": liked},
    }).done(function (data) {
        $('#l-' + id).html(data.html);
    });
});
}

like('.like', true);
like('.dislike', false);



$(document).on('submit', '.follow', function (event) { 
event.preventDefault();
var el = this;
var msg = $(el).children().text().trim();
var user = $(this).data('user');
var mystyle = $('.style', this);
var style = mystyle.attr('style');
var route = $(this).attr('action');

var toast = $('.toasts .toast:last-child');
var toasts = $('.toasts');
var append = '<div class="toast bg-dark" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000"> <div class="toast-header"> <strong class="mr-auto">Twitter</strong> <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="toast-body text-light"><span class="msg">You Started Following</span><strong class="username">username</strong> </div> </div>';

$.ajax({
    url         :       route,
    type        :       "POST",
    data        :       {"_token": "{{ csrf_token() }}", "style" : style},
    success     :       function(data) {
                            $(el).html(data.html).append(mystyle);
                            toast.find('.username').html(' '+ data.username);      
                            msg === 'Unfollow' ? toast.find('.msg').html('You Unfollowed') : '';                            
                            toast.toast('show');
                            toasts.append(append).children().remove('.hide');
                        }
    });
});

$(document).on('submit', '.delete-tweet', function (event) { 
event.preventDefault();
var el = this;
var tweet = $(this).data('id');
if (confirm('Are You Sure?')) {
    $.ajax({
    url         :       '/tweets/'+tweet+'/delete',
    type        :       "DELETE",
    data        :       {"_token": "{{ csrf_token() }}"},
    success     :       function(data) {        
                            alert('Tweet Is Deleted');
                            $(el).closest('.media').fadeOut(800, function () {
                                $(this).remove();
                            });
                        }
    });
}
});

$(document).on('submit', '.publish', function (event) { 
event.preventDefault();
var route = $(this).attr('action');
$.ajax({
    url         :       route,
    type        :       "POST",
    data        :       $(this).serializeArray(),
    success     :       function (data) {
                            $('.b-error').html('').parent().animate({height: 190},400);
                            $('.timeline').fadeOut(100, function () {
                                $(this).html(data.html).fadeIn();
                            });
                            $('.publish textarea').val('');
                            $('.publish .count').text('255');
                        },
    error:              function (xhr) {
                            $('.b-error').parent().animate({height: 250},400);
                            $('.b-error').html('').fadeOut(100, function () {
                                $(this).fadeIn(400, function () {
                                    $.each(xhr.responseJSON.errors, function(key,value) {
                                        $('.b-error').append('<div>'+value+'</div');
                                    }); 
                                });
                            });
                        },
    });
});

</script>
    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @php
    echo $lang == 'ar' ? 
    '<link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
    integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    ' : '';
    @endphp
    <style>
        textarea{resize: none}
    </style>
</head>
<body>
    <div id="app">

        <section class="py-1 mb-3">

            <main class="container mx-auto p-0">
                <header class="d-none d-xl-flex p-0 align-items-center justify-content-between">
                    <a href="/home">
                        <img src="/images/logo.svg" alt="Twitter" height="65">
                    </a>

                    <div class="d-flex">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="p-1 h6">
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                    
                </header>
                
                <nav class="navbar navbar-expand-xl navbar-light bg-light d-xl-none px-2 px-sm-0">
                    <a class="navbar-brand" href="/home"><img src="/images/logo.svg" alt="" height="60"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @if (auth()->check())
                        @include('_sidebar-links')
                        @endif
                    </div>
                </nav>
            </main>
            
        </section>
    
        {{ $slot }}
    </div>
<script>

Pusher.logToConsole = true;

var pusher = new Pusher('1853c172efa24b620d3e', {encrypted: false});

var channel = pusher.subscribe('like-event');

channel.bind('App\\Events\\LikeEvent', function (data) {

    var notificationsCountElem = $(`*[data-count='${data.id}']`);
    
    notificationsCountElem.text(data.count);
    notificationsCountElem.text() == 0 ? '' :  notificationsCountElem.show();

});

</script>

</body>
</html>

{{-- 
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    
    --}}

    {{-- <section class="px-lg-2 py-1 mb-3">
        <header class="container mx-auto">
            <h1><img src="/images/logo.svg" alt="Twitter" height="65"></h1>
        </header>
    </section> --}}
