<div>
  <a href="#" class="widget-view" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-tooltip="Notifications" data-tooltip-location="bottom">
    <div class="icon-area">
      <i class="fas fa-bell text-dark" id="notif"></i>
      <span class="notify"><span class="badge badge-warning">{{number_format($data->count(),0)}}</span></span>
    </div>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" wire:ignore.self>
      <span class="dropdown-item dropdown-header">New Notifications</span>
        <div class="scrollable-notif">
          @forelse($data as $notif)
            <a href="#" class="dropdown-item">
              <i class="fas fa-bell mr-2"></i> {{ucfirst($notif->message)}}
              <span class="float-right text-muted text-sm">{{$notif->created_at}}</span>
            </a>
          @empty
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> No new notifications.
            </a>
          @endforelse
        </div>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
  </a>
  <audio id="NotifSound">
    <source src="{{asset('sounds/notification.mp3')}}" type="audio/mpeg">
  </audio>
</div>
@push('scripts')
<script>
  window.livewire.on('notifications', message => {
      $( "#notif" ).effect( "shake", { times: 2, distance: 5}, 500 );
      $( "#NotifSound")[0].play()
  });

</script>
@endpush
