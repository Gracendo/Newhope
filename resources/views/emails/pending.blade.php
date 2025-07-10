@component('mail::message')
# Greetings {{ $user->first_name }} {{ $user->last_name }},

Thank you for registering.  
Please click the button below to go back to the platform:

@component('mail::button', ['url' => $activationUrl])
Go back to Newhope
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
