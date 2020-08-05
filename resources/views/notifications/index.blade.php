<x-app>
    <div>

        <div class="mb-5">
            <div class="card rounded-bg">
                <div class="card-header h4">
                    <i class="fas fa-bell"></i>
                    New Notifications
                </div>
                <div class="card-body p-0">
                    <ul class="list-unstyled m-0">
                        @include('notifications.new-notifications')
                    </ul>
                </div>
            </div>
        </div>

        <div>
            <div class="card">
                <div class="card-header h4">
                    <i class="far fa-bell"></i>
                    Old Notifications
                </div>
                <div class="card-body p-0">
                    <ul class="list-unstyled m-0">
                        @include('notifications.old-notifications')
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</x-app>