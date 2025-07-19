@component('mail::message')
# Account Approved

Hello {{ $admin->first_name }},

Your admin account has been **approved**. You can now access the system.

@component('mail::button', ['url' => route('admin.login')])
Login to Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent