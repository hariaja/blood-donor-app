@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="{{ asset('assets/images/logo_dark.png') }}" alt="Brand Logo" width="50%">
{{-- {{ $slot }} --}}
@endif
</a>
</td>
</tr>
