@component('mail::message')

{{ucfirst($notification_details['message'])}}

@component('mail::button', ['url' => $notification_details['url_link'] ])
Proceed
@endcomponent

Thanks,<br>
{{ config('app.name') }}

{{-- Subcopy --}}
@component('mail::subcopy')
If you’re having trouble clicking the "PROCEED" button, copy and paste the URL below
into your web browser: [{{ $notification_details['url_link'] }}]({{ $notification_details['url_link'] }})
@endcomponent

@endcomponent
