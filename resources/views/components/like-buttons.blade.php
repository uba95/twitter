    <div class="mt-2 h5 d-flex border p-2 rounded-lg align-items-center" 
    style="color:#666;background-color:#eee" >

        <form  class="like" data-id="{{ $tweet->id }}" action="{{localRoute(route('like', $tweet->id))}}">
            @csrf 
            <div class="mr-4">
                <button class="btn btn-lg" type="submit">
                    <div 
                    class="{{ $tweet->isLikedBy(current_user()) ? 'text-primary' : '' }}" 
                    style="color:#666">
                        <i class="fas fa-thumbs-up"></i>
                        <span>{{ $tweet->likes_sum ?: 0 }}</span>
                    </div>
                </button>
            </div>
        </form>

        <form class="dislike" data-id="{{ $tweet->id }}" action="{{localRoute(route('like', $tweet->id))}}">
            @csrf
            <div class="mr-4">
                <button class="btn btn-lg" type="submit">
                    <div 
                    class="{{ $tweet->isDisLikedBy(current_user()) ? 'text-primary' : '' }}" 
                    style="color:#666">
                        <i class="fas fa-thumbs-down"></i>
                        <span>{{ $tweet->dislikes_sum ?: 0 }}</span>
                    </div>
                </button>
            </div>
        </form>
        @can('delete', $tweet)
            <form class="ml-auto mr-4 delete-tweet" data-id="{{ $tweet->id }}">
                @csrf
                <button class="btn btn-lg" type="submit">
                    <div style="color: #666"><i class="fas fa-trash"></i></div>
                </button>
            </form>
        @endcan
    </div>
