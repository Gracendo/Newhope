@component('mail::message')
# Bonjour {{ $user->first_name }} {{ $user->last_name }},

Merci pour votre inscription.  
Cliquez sur le bouton ci-dessous pour activer votre compte :

@component('mail::button', ['url' => $activationUrl])
Activer mon compte
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
