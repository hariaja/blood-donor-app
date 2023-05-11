<x-mail::message>
<div class="mb-4">
  <div class="text-center">
    <h4 class="fw-semibold">
      Dear, {{ $data['name'] }}
    </h4>
  </div>
</div>

Terimakasih sudah melakukan donor darah,
Anda sudah menjadi pahlawan bagi manusia. Jika anda ingin melakukan dengan rutin maka datang kembali pada jadwal yang sudah ditentukan oleh petugas.

Terimakasih, <br>
{{ config('site.company.name') }} <br>
{{ Constant::ADMIN }} {{ config('app.name') }}
</x-mail::message>
