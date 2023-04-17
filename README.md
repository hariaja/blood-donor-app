# Aplikasi Pendaftaran Donor Darah
Aplikasi ini digunakan untuk pendaftaran calon pendonor darah melakukan donor darah di Palang Merah Indonesia Kota Sukabumi.
Aplikasi ini dibangun menggunakan Framework Laravel 10 dan bertujuan sebagai salah satu syarat kelulusan Program D3 Politeknik Sukabumi Prodi Teknik Komputer.

### Requirement
- Terinstall Node JS https://nodejs.org/en/download
- Composer versi up to 2.4 https://getcomposer.org/Composer-Setup.exe
- PHP minimum versi 8.0
- Anda bisa menggunakan tools dibawah ini: (Pilih salah satu)
* XAMPP: https://www.apachefriends.org/download.html
* LARAGON: https://laragon.org/download/index.html
* WampServer: https://sourceforge.net/projects/wampserver/

### Instalasi
- Clone projek ini dengan perintah git clone https://github.com/hariaja/blood-donor-app.git
- Buka terminal projek setelah meng-clone, kemudian jalankan perintah dibawah ini

```
composer install
```

```
cp .env.example .env
```

```
php artisan key:generate
```

```
npm install
```

```
npm run dev
```

- Konfigurasi database (MySQL, PosgreSQL dll)
- Hubungkan database (yang sudah dibuat) dengan projek
- Kemudian jalankan perintah dibawah ini

```
php artisan migrate:fresh --seed
```

- Jalankan serve dengan:
```
php artisan serve
```
- Jika ketika menjalankan projek ada gambar yang tidak muncul, cukup jalankan perintah
```
php artisan storage:link
```

* LARAVEL DOCUMENTATION: https://laravel.com/docs/10.x