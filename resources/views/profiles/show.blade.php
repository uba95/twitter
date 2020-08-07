<x-app>
    
    <x-slot name="friends">
        @include('_friends-list', ['fUser' => $user])
    </x-slot>
        
    <header class="mb-3">
            
        <div class="position-relative">
            <div class="rounded-lg" style="height: calc(9vw + 80px);
            background-image: url({{ $user->cover }});background-size: cover;background-position: center">
                {{-- cover_img --}}
            </div>

            @auth
                @if (current_user()->is($user))
                <form action="{{ route('profile', current_user()) }}/cover" method="POST" enctype="multipart/form-data"
                class="position-absolute" style="top:1%; right:1%">
                    @csrf @method('PATCH')
                    <i class="fas fa-image h3 m-0 text-secondary" style="color:#eee"></i>
                    <input type="file" class="position-absolute cover" name="cover"
                    style="width:30px;height:25px;top:0; right:0;opacity:0;font-size: 0;cursor: pointer;"
                    z-index="2" data-toggle="tooltip" data-placement="bottom" title="Change Cover">
                    @error('cover')
                        @php
                            function alert($msg) { echo "<script type='text/javascript'>alert('Error :  $msg');</script>"; }
                            alert($message);
                        @endphp
                    @enderror
                </form>
                <script type="text/javascript">
                    $('.cover').change(function () { $(this).parent().submit(); });
                </script>
                @endif        
            @endauth

            <div class="rounded-circle position-absolute border"
            style="width:calc(6vw + 45px); height:calc(6vw + 45px); left:50%; bottom:0;
            transform: translateX(-50%) translateY(50%);background-image: url({{ $user->avatar }});
            background-size: cover;border-color:#107cd8!important">
                {{-- avatar_img --}}
            </div>

            {{-- <img src="{{ $user->avatar }}" alt="avatar"
            class="" 
            style="width:calc(6vw + 45px); height:calc(6vw + 45px); left:50%; bottom:0;
            transform: translateX(-50%) translateY(50%);"> --}}
        </div>
        
        <div class="d-flex align-items-center justify-content-between mt-2 mt-sm-2">

            <div>
                {{-- <h4 class="font-weight-bold mb-0 mt-0 d-none d-sm-inline">{{ $user->name }}</h4>
                <div class="small text-muted d-none d-sm-inline">{{ '@' . $user->username }}</div> --}}
                <div class="small text-muted">{{__('messages.Joined')}} {{ $user->created_at->diffForHumans() }}</div>
            </div>

            <div class="">

            @can('edit', $user)
                <a href="{{ route('profile', current_user()) }}/edit" class="btn btn-outline-primary rounded-pill p-sm-2 mb-sm-0">
                    {{__('messages.Edit Profile')}}
                </a>
            @endcan
            <x-follow-button :user="$user"></x-follow-button>
            </div>

        </div>
        <h4 class="font-weight-bold mb-0 mt-md-3 text-center">{{ $user->name }}</h4>
        <div class=" text-muted text-center" style="text-align: -webkit-auto;" dir="auto">{{ '@' . $user->username }}</div>
        <div class=" mb-4 mt-2 mt-lg-3 mt-xl-4 p-2 rounded-lg" style="background-color:#cfeaf5;word-break: break-all;text-align: -webkit-auto;" dir="auto">
            {{$user->bio}}
        </div>
    
    </header>
    
        {{-- @include('_timeline', ['tweets' => $user->tweets]) --}}
        @include('_timeline')
    
</x-app>

