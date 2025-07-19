@component('mail::message')
# Account Not Approved

Hello {{ $admin->first_name }},

We regret to inform you that your admin account request has been **rejected**.

@if($reason)
**Reason:** {{ $reason }}
@endif

If you believe this is a mistake, please contact us.

Thanks,<br>
{{ config('app.name') }}
@endcomponent