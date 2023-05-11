<x-mail::message>
# Dear, {{ $data['name'] }}

Mohon maaf sebelumnya, pendaftaran anda pada tanggal <b>{{ $data['created_at'] }}</b> belum bisa di proses.

Saat ini status pendaftaran anda berstatus <b>{{ $data['status'] }}</b>, 
silahkan hubungi admin atau periksa kembali data yang anda masukkan pada form pendaftaran.

ALASAN PENOLAKAN : {{ $data['message'] }}

Terimakasih, <br>
{{ config('site.company.name') }} <br>
{{ Constant::ADMIN }} {{ config('app.name') }}
</x-mail::message>