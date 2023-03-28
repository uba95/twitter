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
        {{$styleClass ?? 'style-b'}}
        "
        >
            {{ current_user()->isFollowing($user) ?
             __('messages.Unfollow') :
             __('messages.Follow') }}
        </button>

        <input type="hidden" name="id" class="not-userid" value="{{$user->id}}" />

    </form>
    
    @endunless
    @else
    <a href="/login" class="btn btn-primary btn-lg">Follow</a>
@endif