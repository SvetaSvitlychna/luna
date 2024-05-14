@component('mail::message')
# Introduction

{{$name}}
##The body of your message.
{{$message}}
@component('mail::button', ['url' => $url_l])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
