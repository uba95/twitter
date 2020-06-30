<ul class="list-unstyled d-none d-lg-block rounded-lg p-lg-2 w-100"
style="background-color:#cfeaf5; height: fit-content;}">
    <li><a href="/home" class="font-weight-bold h5 mb-4 mt-2 text-decoration-none text-body d-block">
        <i class="fas fa-home fa-fw mr-1"></i>
        Home</a></li>
    <li><a href="/explore" class="font-weight-bold h5 mb-4 text-decoration-none text-body d-block">
        <i class="fas fa-hashtag fa-fw mr-1"></i>
        Explore</a></li>
    <li><a href="/notifications" class="font-weight-bold h5 mb-4 text-decoration-none text-body d-block">
        <i class="fas fa-bell fa-fw mr-1"></i>
        Notifications</a></li>
    <li>
        <a href="{{ route('profile', auth()->user()) }}" class="font-weight-bold h5 mb-4 text-decoration-none text-body d-block">
            <i class="fas fa-user fa-fw mr-1"></i>
            Profile</a></li>

    <div class="dropdown-divider" style="border-color:#999;"></div>

    <li>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn p-0 font-weight-bold mb-4 text-decoration-none text-body" style="font-size: 1.125rem">
                <i class="fas fa-sign-out-alt fa-fw mr-1"></i>
                Logout</button>
        </form>
    </li>

</ul>

<ul class="navbar-nav mr-auto d-lg-none px-2">
    <li class="nav-item"><a href="/home" class=" nav-link mb-1 text-decoration-none text-dark">
        <i class="fas fa-home fa-fw mr-1"></i>
        Home</a></li>
    <li class="nav-item"><a href="/explore" class=" nav-link mb-1 text-decoration-none text-dark">
        <i class="fas fa-hashtag fa-fw mr-1"></i>
        Explore</a></li>
    <li class="nav-item"><a href="/notifications" class=" nav-link mb-1 text-decoration-none text-dark">
        <i class="fas fa-bell fa-fw mr-1"></i>
        Notifications</a></li>
    <li class="nav-item"><a href="{{ route('profile', auth()->user()) }}" class=" nav-link mb-1 text-decoration-none text-dark">
        <i class="fas fa-user fa-fw mr-1"></i>
        Profile</a></li>
    
    <div class="dropdown-divider" style="border-color:#999;"></div>

    <li class="nav-item">
        <form action="/logout" method="POST" class="nav-link">
            @csrf
            <button type="submit" class="btn p-0 mb-1 text-decoration-none text-dark">
                <i class="fas fa-sign-out-alt fa-fw mr-1"></i>
                Logout</button>
        </form>
    </li>
    
</ul>