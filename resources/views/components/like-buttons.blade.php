    <div class="mt-2 h5 d-flex border p-2 rounded-lg align-items-center" 
    style="color:#666;background-color:#eee" >

        <form  class="like" data-id="{{ $tweet->id }}" action="{{localRoute(route('like', $tweet->id))}}">
            @csrf 
            <div class="mr-2">
                <button class="btn btn-lg" type="submit">
                    <div 
                    class="{{Auth::check() && $tweet->isLikedBy(current_user()) ? 'text-primary' : '' }}" 
                    style="color:#666">
                        <i class="fas fa-thumbs-up d-inline"></i>
                        <span>{{ $tweet->likes_sum ?: 0 }}</span>
                    </div>
                </button>
            </div>
        </form>

        <form class="dislike" data-id="{{ $tweet->id }}" action="{{localRoute(route('like', $tweet->id))}}">
            @csrf
            <div class="mr-2">
                <button class="btn btn-lg" type="submit">
                    <div 
                    class="{{Auth::check() && $tweet->isDisLikedBy(current_user()) ? 'text-primary' : '' }}" 
                    style="color:#666">
                        <i class="fas fa-thumbs-down d-inline"></i>
                        <span>{{ $tweet->dislikes_sum ?: 0 }}</span>
                    </div>
                </button>
            </div>
        </form>
        
        @can('delete', $tweet)
            <form class="ml-auto mr-2 delete-tweet" data-id="{{ $tweet->id }}" action="{{localRoute(route('tweet.delete', $tweet->id))}}">
                @csrf
                <button class="btn btn-lg" type="submit">
                    <div style="color: #666"><i class="fas fa-trash d-inline"></i></div>
                </button>
            </form>
        @endcan
    </div>
