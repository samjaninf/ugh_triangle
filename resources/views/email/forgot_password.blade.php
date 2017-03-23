Здравей {!! $user->name !!},
<hr>
Твоята нова парола е: {!! $password !!}<br>
Може да я промениш като влезеш в акаунта си от <a href="{!! url('/') !!}">ТУК</a>.
@include('email.parts.footer')