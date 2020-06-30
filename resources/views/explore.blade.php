<x-app>
@include('friends-box')
<h3 class="mb-3">Find People To Follow!</h3>
<div class="border border-bottom-0 mb-5">
    <div class="infinite-scroll">
        @foreach ($users as $user)
            <div class="row m-0 py-2 px-0 px-sm-2 align-items-center border-bottom">

                <div class="col-8 col-sm-6">

                    <div class="row align-items-center">
                        <a href="{{ route('profile', $user->username) }}" class="col-3 mr-2 mr-md-0 text-decoration-none text-body">
                            {{-- <img src="{{$user->avatar}}" alt="avatar" width="60" height="60"class="rounded-circle"> --}}
                            <div class="rounded-circle "
                            style="width:60px; height:60px;background-image: url({{ $user->avatar }});
                            background-size: cover;">
                                {{-- avatar_img --}}
                            </div>                
                        </a>

                        <div class="col-8">
                            <a href="{{ route('profile', $user->username) }}" class="text-decoration-none text-body">
                                <h5 class="m-0">{{$user->name}}</h5>
                            </a>
                            <div class="text-muted">{{ '@' . $user->username }}</div>
                        </div>

                    </div>

                </div>

                <div class="col-4 col-sm-5">
                    <x-follow-button :user="$user"></x-follow-button>
                </div>

            </div>
        @endforeach
        {{$users->links()}}
    </div>
</div>
</x-app>
{{-- <style>
    .fb {width:calc(1.5vw + 70px);height:calc(0.8vw + 30px)}
</style> --}}
{{-- <a href="" class=" mb-2 text-decoration-none text-body p-2 {{ $loop->last ? '' : 'border-bottom'  }}">
    <img src="{{$user->avatar}}" alt="avatar" width="60" height="60"class="mr-2 rounded-circle">
    <h5 class="mb-1">{{$user->name}}</h5>
    <div class="text-muted">{{ '@' . $user->username }}</div>
</a>

<x-follow-button :user="$user"></x-follow-button> --}}

{{-- <div class="media p-2 {{ $loop->last ? '' : 'border-bottom'  }}">
    <a href="{{ route('profile', $user) }}"class="text-decoration-none text-dark"> 
        <img src="{{ $user->avatar }}" alt="John Doe" class="mr-3 mt-3 rounded-circle" width="40" height="40">
    </a>
    <div class="media-body">
        <div class="font-weight-bold">
            <a href="{{ route('profile', $user) }}"class="text-decoration-none text-dark"> 
                {{ $user->name }}
            </a>
        </div>
        <span class="text-muted">{{ '@' . $user->username }}</span>
        <div>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas voluptatem sit nemo quidem at,
            illo labore nobis magni voluptatibus quisquam?
        </div>
    </div>
</div> --}}
