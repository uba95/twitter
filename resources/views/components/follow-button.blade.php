@if (auth()->check())
    @unless (current_user()->is($user))

    {{-- <form action="{{ route('profile', $user->username) }}/follow" method="POST"> --}}
    
    <form data-user="{{ $user->username }}" action="{{localRoute(route('follow', $user->username))}}"
        class="follow" >
        @csrf
        {{$slot?? ''}}
        <button type="submit" 

        class="btn rounded-pill text-white mb-sm-0 p-0 fb
        {{ current_user()->isFollowing($user) ?
        'btn-danger':
        'btn-primary' }}
        {{ $myClass ?? '' }}
        "
        style="{{$style ?? 'width:calc(1.5vw + 70px);height:calc(0.8vw + 30px);font-size:0.9rem'}}"
        >
            {{ current_user()->isFollowing($user) ?
            'Unfollow' :
            'Follow' }}
        </button>
    </form>
    
    @endunless
    @else
    <a href="/login" class="btn btn-primary btn-lg">Follow</a>
@endif

<x-slot name="toast">
    <div class="toasts" style="position: fixed; bottom: -80px; right: 10px;z-index:99">
        <div class="toast bg-dark" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-header">
                <strong class="mr-auto">Twitter</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body text-light">        
            <span class="msg">You Started Following</span><strong class="username">username</strong>
            </div>
        </div>    
    </div>
</x-slot>