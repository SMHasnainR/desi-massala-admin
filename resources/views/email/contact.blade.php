@component('mail::message')
# User Message

## Name : {{ $name }}
## Email : {{ $email }}
## Message : {{ $message }}

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
