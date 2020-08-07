<div class="mb-4 rounded-lg p-2" style="background-color:#cfeaf5">
    <h4 class="font-weight-bold mb-4">{{__('messages.Following')}}</h4>
    <ul class="list-unstyled">
        @forelse ($fUser->follows->sortByDesc('created_at')->take(5) as $user)
            <li class="mb-3">
                <div class="row align-items-center mx-0">
                    <a href="{{ route('profile', $user) }}"
                        class="col-lg-2 text-decoration-none text-dark rounded-circle" 
                        style="width:40px; height:40px;background-image: url({{ $user->avatar }});background-size: cover;"> 
                    </a>
                    <div class="col-lg-6">
                        <a href="{{ route('profile', $user) }}"
                        class="text-decoration-none text-dark small font-weight-bold"> 
                            {{ $user->name }}
                        </a>
                        <div class="small text-muted" style="word-break:break-all"> {{ '@'. $user->username }}</div>
                    </div>
                    <x-follow-button :user="$user" class="col-lg-2 p-0" styleClass='style'></x-follow-button>
                </div>
            </li>
            @empty
        
            <div class="text-muted">{{__('messages.No Following Yet.')}}</div>
    
        @endforelse
        </ul>
</div>

<div class="mb-4 rounded-lg p-2" style="background-color:#cfeaf5">
    <h4 class="font-weight-bold mb-4">{{__('messages.Followers')}}</h4>
    <ul class="list-unstyled">
        @forelse ($fUser->followers->sortByDesc('created_at')->take(5) as $user)
        <li class="mb-3">
            <div class="row align-items-center mx-0">
                <a href="{{ route('profile', $user) }}"
                    class="col-lg-2 text-decoration-none text-dark rounded-circle" 
                    style="width:40px; height:40px;background-image: url({{ $user->avatar }});background-size: cover;"> 
                </a>
                <div class="col-lg-6">
                    <a href="{{ route('profile', $user) }}"
                    class="text-decoration-none text-dark small font-weight-bold"> 
                        {{ $user->name }}
                    </a>
                    <div class="small text-muted" style="word-break:break-all"> {{ '@'. $user->username }}</div>
                </div>
                <x-follow-button :user="$user" class="col-lg-2 p-0" styleClass='style'></x-follow-button>
            </div>
        </li>
        @empty
        
            <div class="text-muted">{{__('messages.No Followers Yet.')}}</div>
    
        @endforelse
        </ul>
</div>