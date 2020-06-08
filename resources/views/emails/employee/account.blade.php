@component('mail::message')
#Hello {{ $employee->first_name }}

Your account password is {{ $password }}

@component('mail::button', ['url' => $url, 'color' => 'success'])
Login here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
