@component('mail::message')
# Recipe Created

A new recipe has been created by user.
Click below to view it.

@component('mail::button', ['url' => config('app.url').'/admin/recipes/user'])
Admin Panel
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
