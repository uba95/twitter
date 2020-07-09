<div class="border border-primary rounded-lg px-3 px-lg-4 py-3 mb-5">

    <form class="publish" action="{{localRoute('/tweets')}}">
        @csrf
        <textarea placeholder=" {{__('messages.Whats\'s up doc?')}}" name="body"
        class="w-100 rounded-lg form-control @error('body') is-invalid @enderror" rows="4"
        ></textarea>

        <hr class="my-2 my-lg-3">

        <footer class="d-flex align-items-center">

            {{-- <img src="{{ current_user()->avatar }}" width="40" height="40" alt="" class="rounded-circle mr-1"> --}}
            <div class="rounded-circle "
            style="width:40px; height:40px;background-image: url({{ current_user()->avatar }});
            background-size: cover;">
                {{-- avatar_img --}}
            </div>

            <span class="small ml-1">{{ current_user()->name }}</span>

            <div class="ml-auto">
                <span class="text-primary count">255</span>
                <span> / </span>
                <span>255</span>
                <button type="submit" class="btn btn-primary rounded-pill p-2 px-3 text-white tweet" disabled>{{__('messages.Tweet')}}</button>
            </div>


        </footer>
        
        <small class="b-error text-danger mt-1 ml-2" style="display: none"></small>

            {{-- @error('body')
            <div class="text-danger mt-1 ml-2">
                <small class="b-error">{{ $message }}</small>
            </div>
            @enderror --}}
    </form>
</div>
<script>
    $('.publish textarea').on('input', function () {
        var remaining = 255 - $(this).val().length;
        var count = $('.publish .count');
        $(count).text(remaining);

        if (remaining < 0) {
            $('.tweet').prop('disabled', true);
            $(count).removeClass('text-primary').addClass('text-danger');

        } else if (remaining == 255) {
            $('.tweet').prop('disabled', true);

        } else {
            $('.tweet').prop('disabled', false);
            $(count).removeClass('text-danger').addClass('text-primary');
        }

    });
</script>
