@component('mail::message')

# Hello

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => ''])
Reset Password
@endcomponent

Regards,<br>

{{ config('app.name') }}

@component('mail::subcopy', ['url' => ''])
If you’re having trouble clicking the "Reset " button, copy and paste the URL below
into your web browser: [{{ ''}}]({{ ''}})
@endcomponent
@endcomponent
