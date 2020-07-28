@component('mail::message')
## Introduction

The body of your message.
-Team
-Ahmed Qeshta
-Ahmed Qeshta
@component('mail::button', ['url' => 'https://my1cv.000webhostapp.com/'])
My CV
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
