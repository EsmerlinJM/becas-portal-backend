<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
{{-- <img src="https://storage.googleapis.com/becas-backend-storage/APP_IMAGES/Logo_BECATUFUTURO_BIG.png" alt="Beca Tu Futuro Logo"> --}}
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
