<x-mail::message>
<div class="mb-4">
  <div class="text-center">
    <h4 class="fw-semibold">
      Dear, {{ $data['name'] }}
    </h4>
  </div>
</div>

Karena ada beberapa penyesuaian yang terjadi, maka berikut di bawah ini data pengambilan darah anda yang baru :

<ul class="list-group push mb-2">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Tanggal
    <span class="fw-semibold">{{ $data['date'] }}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Jam
    <span class="fw-semibold">{{ $data['time'] }} WIB</span>
  </li>
</ul>

<ul class="list-group push mb-2">
  <li class="list-group-item text-center">
    Lokasi Pengambilan Darah
  </li>
  <li class="list-group-item text-center">
    <span class="fw-semibold">{{ config('site.company.name') }}</span>
  </li>
</ul>

<ul class="list-group push mb-4">
  <li class="list-group-item text-center">
    Alamat Lengkap
  </li>
  <li class="list-group-item text-center">
    <span class="fw-semibold">{{ config('site.company.address') }}</span>
  </li>
</ul>

Atas perhatiannya kami ucapkan terimakasih banyak dan dimohon untuk datang tepat pada waktunya.

Terimakasih,<br>
{{ config('site.company.name') }} <br>
{{ Constant::ADMIN }} {{ config('app.name') }}
</x-mail::message>
