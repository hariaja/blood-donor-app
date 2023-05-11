<x-mail::message>
<div class="mb-4">
  <div class="text-center">
    <h4 class="fw-semibold">
      Dear, {{ $data['name'] }}
    </h4>
  </div>
</div>

Kami mengundang anda untuk melakukan pengambilan darah dengan detail lokasi sebagai berikut :

<ul class="list-group push mb-1">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Tanggal
    <span class="fw-semibold">{{ $data['date'] }}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Jam
    <span class="fw-semibold">{{ $data['time'] }} WIB</span>
  </li>
</ul>

<ul class="list-group push mb-4">
  <li class="list-group-item text-center">
    Lokasi Pengambilan Darah
  </li>
  <li class="list-group-item text-center">
    <span class="fw-semibold">{{ config('site.company.name') }}</span>
  </li>
  <li class="list-group-item text-center">
    Alamat Lengkap
  </li>
  <li class="list-group-item text-center">
    <span class="fw-semibold">{{ config('site.company.address') }}</span>
  </li>
</ul>

Silahkan untuk membawa kartu pendaftaran yang sudah anda cetak untuk diberikan kepada petugas.

Terimakasih,<br>
{{ config('site.company.name') }} <br>
{{ Constant::ADMIN }} {{ config('app.name') }}
</x-mail::message>
