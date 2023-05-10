<x-mail::message>
# Dear, {{ $data['name'] }}

Terimakasih sudah menjadi bagian dari manusia baik. <br>
Pendaftaran anda pada tanggal <b>{{ $data['created_at'] }}</b> berhasil disubmit.
Dengan ini status pendaftaran anda sudah dilakukan <b>{{ $data['status'] }}</b> oleh <b>{{ $data['approved_by'] }}</b>.

Untuk info selanjutnya, silahkan untuk menunggu informasi berikutnya untuk dilakukan pengambilan darah.

Thanks,<br>
Palang Merah Indonesia Kota Sukabumi <br>
{{ Constant::ADMIN }} {{ config('app.name') }}
</x-mail::message>
