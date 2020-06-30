<div class="border border-bottom-0 mb-5">

<div class="infinite-scroll">

        @forelse ($tweets as $tweet)

            @include('_tweet')
        @empty

            <div class="text-muted p-2">No Tweets Yet.</div>

        @endforelse

        {{$tweets->links()}}
</div>
</div>
<script>
    $(document).ready(function () {        
    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<div class="text-center mt-5"><div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div></div>',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
    });
</script>