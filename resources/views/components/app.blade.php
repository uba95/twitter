<x-master>
    <section class="">
        <main class="container mx-auto p-0" >
            <div class=" d-lg-flex justify-content-between">

                @if (auth()->check())
                    <div class="col col-xl-2 p-xl-0 d-none d-xl-flex">
                        @include('_sidebar-links')
                    </div>
                @endif

                    <div class="col col-12 col-lg-8 col-xl-7 px-2 px-sm-0 px-lg-3
                    {{auth()->check() ? '' : 'mx-auto'}} ">
                        {{ $slot }}
                    </div>
                    
                @if (auth()->check())
                    <div class="col col-lg-4 col-xl-3 px-0 d-none d-lg-flex flex-column">
                        {{ $friends }}
                    </div>
                @endif
                {{ $toast ?? ''  }}
            </div>
        </main>
    </section>
</x-master>