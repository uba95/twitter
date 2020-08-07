<ul class="list-unstyled d-none d-xl-block rounded-lg p-lg-2 w-100"
style="background-color:#cfeaf5; height: fit-content;}">
    <li><a href="/home" class="font-weight-bold h6 mb-4 mt-2 text-decoration-none text-body d-block">
        <i class="fas fa-home fa-fw mr-1"></i>
        {{__('messages.Home')}}</a></li>
    <li><a href="/explore" class="font-weight-bold h6 mb-4 text-decoration-none text-body d-block">
        <i class="fas fa-hashtag fa-fw mr-1"></i>
        {{__('messages.Explore')}}</a></li>
    <li><a href="/notifications" class=" font-weight-bold h6 mb-4 text-decoration-none text-body d-block">
        <i class="fas fa-bell fa-fw mr-1"></i>
        {{__('messages.Notifications')}}

        <span class="badge badge-danger ml-1 not_count" data-count="{{ current_user()->id }}">{{current_user()->unreadNotifications->count()}}</span>
        <script>$('ul li .not_count').text() == 0 ? $('ul li .not_count').hide() :  ''</script>
    </a></li>
    <li>
        <a href="{{ route('profile', auth()->user()) }}" class="font-weight-bold h6 mb-4 text-decoration-none text-body d-block">
            <i class="fas fa-user fa-fw mr-1"></i>
            {{__('messages.Profile')}}</a></li>

    <div class="dropdown-divider" style="border-color:#999;"></div>

    <li>
        <form action="{{localRoute('/logout')}}" method="POST">
            @csrf
            <button type="submit" class="btn p-0 font-weight-bold mb-4 text-decoration-none text-body" style="font-size: 1rem">
                <i class="fas fa-sign-out-alt fa-fw mr-1"></i>
                {{__('messages.Logout')}}</button>
        </form>
    </li>

</ul>

<ul class="navbar-nav mr-auto d-xl-none px-2">
    <li class="nav-item"><a href="/home" class=" nav-link mb-1 text-decoration-none text-dark">
        <i class="fas fa-home fa-fw mr-1"></i>
        {{__('messages.Home')}}</a></li>
    <li class="nav-item"><a href="/explore" class=" nav-link mb-1 text-decoration-none text-dark">
        <i class="fas fa-hashtag fa-fw mr-1"></i>
        {{__('messages.Explore')}}</a></li>
    <li class="nav-item"><a href="/notifications" class=" nav-link mb-1 text-decoration-none text-dark">
        <i class="fas fa-bell fa-fw mr-1"></i>
        {{__('messages.Notifications')}}

        <span class="badge badge-danger ml-1 not_count" data-count="{{ current_user()->id }}">{{current_user()->unreadNotifications->count()}}</span>
        <script>$('ul li .not_count').text() == 0 ? $('ul li .not_count').hide() :  ''</script>
        </a></li>
    <li class="nav-item"><a href="{{ route('profile', auth()->user()) }}" class=" nav-link mb-1 text-decoration-none text-dark">
        <i class="fas fa-user fa-fw mr-1"></i>
        {{__('messages.Profile')}}</a></li>
    
    <div class="dropdown-divider" style="border-color:#999;"></div>

    <li class="nav-item d-flex justify-content-between">
        <form action="{{localRoute('/logout')}} " method="POST" class="nav-link">
            @csrf
            <button type="submit" class="btn p-0 mb-1 text-decoration-none text-dark">
                <i class="fas fa-sign-out-alt fa-fw mr-1"></i>
                {{__('messages.Logout')}}
            </button>
        </form>
        <div class="d-flex">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <div class="p-1 h6">
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </div>
            @endforeach
        </div>
    </li>
    
</ul>