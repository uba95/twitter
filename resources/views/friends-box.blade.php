<x-slot name="friends">
    @include('_friends-list', ['fUser' => isset($user) ? $user : current_user()])
</x-slot>
