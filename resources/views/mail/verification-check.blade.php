@component('mail::message')
    Hi, Good day! <br>
    Here's your Verification Code: <b>{{$details['verification_code']}}</b>

    Thanks,
    {{ env('APP_NAME') }}
@endcomponent