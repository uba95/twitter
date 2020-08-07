<div class="media p-2 border-bottom">
    <a href="{{ route('profile', $tweet->user) }}"class="text-decoration-none text-dark"> 
        {{-- <img src="{{ $tweet->user->avatar }}" alt="John Doe" class="mr-3 mt-3 rounded-circle " width="40" height="40"> --}}
        <div class="rounded-circle mr-3 mt-3"
        style="width:40px; height:40px;background-image: url({{ $tweet->user->avatar }});
        background-size: cover;">
            {{-- avatar_img --}}
        </div>
    </a>
    <div class="media-body">
        <div class="font-weight-bold">
            <div style="display: flex;align-items:center">
                <a href="{{ route('profile', $tweet->user) }}"class="text-decoration-none text-dark"> 
                    {{ $tweet->user->name }}
                </a>
                <span class="small text-muted ml-1" style="text-align: -webkit-auto;" dir="auto"> {{ '@'. $tweet->user->username }}</span>
    
            </div>
            <div class="small text-muted ">{{$tweet->tweetDate() }}</div>

        </div>

        <div class="mt-2" style="word-break: break-all;text-align: -webkit-auto;" dir="auto">
            {{ $tweet->body }}
        </div>
        <div id="l-{{ $tweet->id }}">
            <x-like-buttons :tweet="$tweet"/>
        </div>
    </div>
</div>
