@component('mail::message')
Please find yout OTP for logging into <strong>Al-Quzi Foundation</strong>

<strong>{{$OTP}}</strong>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
