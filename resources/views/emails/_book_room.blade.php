@component('mail::message')

New persion register with information:<br />
Name: {{ $name }}<br />
@if($email)
Email: {{ $email }}<br />
@endif
Mobile: {{ $mobile }}<br />
{!! $content !!}<br />
Note: {{ $note }}

Call now!!!<br>

@endcomponent
