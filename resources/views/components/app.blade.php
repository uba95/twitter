<x-master>
    <section class="my-3">
        <main class="container mx-auto p-0" >
            <div class="d-lg-flex justify-content-between main-div row no-gutters">

                @if (auth()->check())
                    <div class="col-xl-2 px-0 p-xl-0 ">
                        @include('side')
                    </div>
                @endif

                    <div class="col-12 col-lg-8 col-xl-7 px-2 px-sm-0 px-lg-3
                    {{auth()->check() ? '' : 'mx-auto'}} ">
                        {{ $slot }}
                    </div>
                    
                @if (auth()->check())
                    <div class="col-lg-4 col-xl-3 px-0 d-none d-lg-flex flex-column">

                        @if (Route::currentRouteName() === 'profile')

                            {{ $friends }}
                        @else

                            @include('_friends-list', ['fUser' => current_user()])
                        @endif

                        
                    </div>
                    <div class="toasts" style="position: fixed; bottom: 40px; right: 10px;z-index:99"></div>
                @endif
            </div>
        </main>
    </section>
</x-master>
