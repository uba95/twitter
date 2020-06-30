@forelse ($old_notifications as $notification)
    @if ($notification)
        <li class="rounded-bg p-3 d-flex align-items-center
        {{ $loop->last ? '' :  'border-bottom'}}">
            <div class="flex-grow-1">
                <a href="/profiles/{{  $notification->data['username'] }}"
                    class="text-decoration-none text-dark">
                    <strong>{{ $notification->data['name'] }}</strong>
                </a>
                {{$notification->type === 'App\Notifications\FollowNotifacation' ? ' Started Following You' : ''}}
                {{$notification->type === 'App\Notifications\LikeNotifacation' ? 'Liked Your Tweet' : ''}}
            </div>
            <span class="small text-muted">{{ $notification->created_at->diffForHumans() }}</span>
        </li>
    @endif
    @empty
        <li class="rounded-bg p-3">
            <div>There's No Notifications</div>
        </li>
@endforelse
