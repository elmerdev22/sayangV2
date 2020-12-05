<div>
  <a href="#" class="widget-view" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-tooltip="Notifications" data-tooltip-location="bottom">
    <div class="icon-area">
      <i class="fas fa-bell text-dark" id="notif"></i>
      <span class="notify"><span class="badge badge-warning">{{number_format($data->count(),0)}}</span></span>
    </div>
  </a>
  <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right">
    <span class="dropdown-item dropdown-header bg-white">15 Notifications</span>
      <div class="dropdown-divider"></div>
          <div class="scrollable-menu">
              @for ($i = 0; $i < 10; $i++)
                  
              <a href="#" class="dropdown-item">
                  <i class="fas fa-bell mr-2"></i> 4 new messages
                  <span class="float-right text-muted text-sm">3 mins</span>
              </a>
              @endfor
          </div>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item dropdown-footer bg-white">See All Notifications</a>
  </div>
  {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" wire:ignore.self>
    <span class="dropdown-item dropdown-header">15 Notifications</span>
    <div class="dropdown-divider"></div>
      <div class="scrollable-notif">
        @forelse($data as $notif)
          <a href="#" class="dropdown-item">
            <i class="fas fa-bell mr-2"></i> {{ucfirst($notif->message)}}
            <span class="float-right text-muted text-sm">{{Carbon\Carbon::parse($notif->created_at)->diffForHumans()}}</span>
          </a>
        @empty
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> No new notifications.
          </a>
        @endforelse
      </div>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
  </div> --}}
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

{{-- 
      $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type ": "application/json",
            "Authorization": "Bearer A276677AB1C574CBF0F5FEA2C90C4BF3FA9DF6165721E906FB0D684432DF5B20",
        }
      });

      $.ajax({
        method:"POST",
        url: "https://f05bbe51-29ad-489d-8255-35e252bb86ed.pushnotifications.pusher.com/publish_api/v1/instances/f05bbe51-29ad-489d-8255-35e252bb86ed/publishes",
        dataType: 'json',
        data:{
          "interests":["debug-hello"],
          "web":
            {
              "notification":{
                "title":"Hello",
                "body":"Hello, world!"
              }
            }
        },
        success:function(response){
          console.log(response);
        },
      }); --}}