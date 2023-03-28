<nav class="navbar navbar-expand-xl navbar-light bg-light d-xl-block d-flex justify-content-between px-2 px-md-1  p-xl-2 w-100 nav-bg " style="height: fit-content">

    <a class="navbar-brand p-0 m-0 mb-2 d-flex justify-content-center align-items-center" href="/home" style="overflow: hidden;height:40px;width:40px ">
        <img src="/images/logo.svg" alt="" height="60" style="transform: scale(1.1)">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="flex-column rounded-lg  navbar-nav w-100 justify-content-between" >
            <li>
                <a href="/home" class="font-weight-bold h6 mb-4 mt-2 text-decoration-none text-body d-block">
                    <i class="fas fa-home fa-fw mr-1"></i>
                    {{__('messages.Home')}}
                </a>
            </li>
            <li>
                <a href="/explore" class="font-weight-bold h6 mb-4 text-decoration-none text-body d-block">
                    <i class="fas fa-hashtag fa-fw mr-1"></i>
                    {{__('messages.Explore')}}
                </a>
            </li>
            <li>
                <a href="/notifications" class=" font-weight-bold h6 mb-4 text-decoration-none text-body d-block">
                    <i class="fas fa-bell fa-fw mr-1"></i>
                    {{__('messages.Notifications')}}
            
                    <span class="badge badge-danger ml-1 not_count" data-count="{{ current_user()->id }}">{{current_user()->unreadNotifications->count()}}</span>
                    <script>$('ul li .not_count').text() == 0 ? $('ul li .not_count').hide() :  ''</script>
                    </a>
                </li>
            <li>
                <a href="{{ route('profile', auth()->user()) }}" class="font-weight-bold h6 mb-4 text-decoration-none text-body d-block">
                    <i class="fas fa-user fa-fw mr-1"></i>
                    {{__('messages.Profile')}}</a>
            </li>
        
            <div class="dropdown-divider m-0 mb-1" style="border-color:#999"></div>
        
            <li>
                <form action="{{localRoute('/logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="btn p-0 font-weight-bold mb-4 text-decoration-none text-body" style="font-size: 1rem">
                        <i class="fas fa-sign-out-alt fa-fw mr-1"></i>
                        {{__('messages.Logout')}}</button>
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
    </div>
</nav>
