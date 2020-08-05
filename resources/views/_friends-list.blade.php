<div class="mb-4 rounded-lg p-2" style="background-color:#cfeaf5">
    <h4 class="font-weight-bold mb-4">{{__('messages.Following')}}</h4>
    <ul class="list-unstyled">
        @forelse ($fUser->follows->sortByDesc('created_at')->take(5) as $user)
            <li class="mb-3">
                <div class="row align-items-center mx-0">
                    <a href="{{ route('profile', $user) }}"
                        class="text-decoration-none text-dark col-lg-2"> 
                        
                        {{-- <img src="{{ $user->avatar }}" alt="" class="rounded-circle mr-2 " width="40" height="40"> --}}
                        <div class="rounded-circle "
                        style="width:40px; height:40px;background-image: url({{ $user->avatar }});
                        background-size: cover;">
                            {{-- avatar_img --}}
                        </div>            
                    </a>
                    <div class="col-lg-6">
                        <a href="{{ route('profile', $user) }}"
                        class="text-decoration-none text-dark "> 
                            <div class="small font-weight-bold">{{ $user->name }}</div>
                        </a>
                        <div class="small text-muted"> {{ '@'. $user->username }}</div>
                    </div>
                    <div class="col-lg-2 p-0">
                        <x-follow-button :user="$user" style="width:calc(0.5vw + 70px);height:calc(0.1vw + 30px);font-size:0.8rem">
                            <input type="hidden" class="style" style="width:calc(0.5vw + 70px);height:calc(0.1vw + 30px);font-size:0.8rem">
                        </x-follow-button>
                    </div>            
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
                <div class="row">
                    <a href="{{ route('profile', $user) }}"
                        class="text-decoration-none text-dark col-lg-2"> 
                        
                        {{-- <img src="{{ $user->avatar }}" alt="" class="rounded-circle mr-2" width="40" height="40"> --}}
                        <div class="rounded-circle mx-2"
                        style="width:40px; height:40px;background-image: url({{ $user->avatar }});
                        background-size: cover;">
                            {{-- avatar_img --}}
                        </div>            

                    </a>
                    <div class="col-lg-6">
                        <a href="{{ route('profile', $user) }}"
                        class="text-decoration-none text-dark "> 
                            <div class="small font-weight-bold">{{ $user->name }}</div>
                        </a>
                        <div class="small text-muted"> {{ '@'. $user->username }}</div>
                    </div>
                    <div class="col-lg-2 p-0">
                        <x-follow-button :user="$user" style="width:calc(0.5vw + 70px);height:calc(0.1vw + 30px);font-size:0.8rem">
                            <input type="hidden" class="style" style="width:calc(0.5vw + 70px);height:calc(0.1vw + 30px);font-size:0.8rem">
                        </x-follow-button>
                    </div>            
                </div>
            </li>
            @empty
        
            <div class="text-muted">{{__('messages.No Followers Yet.')}}</div>
    
        @endforelse
        </ul>
</div>
{{-- <style>
    .fb {width:calc(1vw + 70px);height:calc(0.5vw + 30px)}
</style> --}}