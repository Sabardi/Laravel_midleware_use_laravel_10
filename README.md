# ============================= Middleware ====================================
# membuat controller
php artisan make:model Mahasiswa -mcr
mksd kode ini adalah akan membuatkan model migration controller
# membuat middleware
php artisan make:middleware CobaMiddleware

# mendaftarkan middleware

public function handle($request, Closure $next)
{
    dd('CobaMiddleware aktif');
    return $next($request);
}

tambahkan dd('') agar mengetahui midllware nya aktif atau tidak


mendaftarkan nya ke karnel.php

1. di bagian protected tambahkan 
\App\Http\Middleware\CobaMiddleware::class
kemudian akses  localhost:8000/daftar-mahasiswa.
2. pindah kode yang kita buat tadi ke dalam web
\App\Http\Middleware\CobaMiddleware::class
 kemudian coba akses kembali
3. Jika kita ingin middleware aktif untuk route tertentu saja, maka tempatkan class middleware
ke dalam property $routeMiddleware.

'coba' => \App\Http\Middleware\CobaMiddleware::class,

 jika muncul aktif berarti tanda nya midlleware nya sudah berhasil di daftarkan

# Mengaktifkan Middleware
Dalam praktek sebelumnya, middleware CobaMiddleware sudah berjalan namun baru sebagai
global middleware. Kali ini kita akan bahas cara mengaktifkan middleware untuk route
tertentu saja. Syaratnya, middleware tersebut harus didaftarkan terlebih dahulu ke dalam
property $routeMiddleware seperti yang sudah kita lakukan.
* Mengaktifkan Middleware dari Route
Untuk mengaktifkan middleware dari route, bisa dengan men-chaining method
middleware('<nama_key>') ke dalam route, 


Route::get('/daftarMahasiswa',[MahasiswaController::class,'daftarMahasiswa'])->middleware('coba');;
Route::get('/tabelMahasiswa', [MahasiswaController::class,'tabelMahasiswa']);
Route::get('/blogMahasiswa', [MahasiswaController::class,'blogMahasiswa'])->middleware('coba');;

Jika terdapat beberapa middleware yang ingin diaktifkan untuk satu route, penulisannya bisa
disambung sebagai berikut:
Route::get('/nama-route', [ContohController::class,'foo']->middleware('pertama',
'kedua');

# Mengaktifkan Middleware dari Controller
Alternatif cara kedua untuk mengaktifkan middleware adalah dari constructor di dalam Controller. 

    public  function __construct(){
        $this->middleware('coba');
    }
Perintah untuk mengaktifkan middleware ditulis dengan format: $this->middleware
551
Middleware
('<nama_key>'). Sehingga untuk menjalankan middleware coba, perintahnya adalah:
$this->middleware('coba');

Bagaimana jika kita ingin mengaktifkan middleware untuk method tertentu saja? Caranya,
chaining dengan method only('<nama_method>'), seperti contoh berikut:
$this->middleware('coba')->only('daftarMahasiswa');

/ Jika kita ingin menambah method lain, bisa ditulis sebagai berikut:
        // $this->middleware('coba')->only('daftarMahasiswa','tabelMahasiswa');

# Redirect Middleware
Dalam praktek sebelumnya kita sudah berhasil menjalankan CobaMiddleware. Namun hasilnya
memang baru sekedar teks saja. Biasanya middleware ini akan me-redirect user ke halaman
lain jika suatu kondisi tidak terpenuhi.

// dd('CobaMiddleware aktif');
        if(time() % 2 == 0){
            return redirect('/tabelMahasiswa');
        }
        return $next($request);

# Laravel Maintenance Mode
middleware bawaan Laravel, yakni
PreventRequestsDuringMaintenance.php. File ini sudah ada di dalam folder app\Http\
Middleware\ dan juga sudah terdaftar sebagai global middleware.

Middleware ini dipakai untuk membuat Laravel masuk ke maintenance mode, dimana
halaman web tidak bisa diakses dari luar. Ini cocok dipakai ketika kita ingin melakukan
maintenance atau pengelolaan aplikasi yang sudah berjalan. Akan jadi masalah jika ada user
yang melihat web kita "berantakan" karena memang sedang ada perubahan kode program.

Untuk mengaktifkan maintenance mode, bisa dilakukan dari cmd dengan perintah berikut:
php artisan down

Setelah proses maintenance selesai, tutup middleware maintenance ini dengan perintah:
php artisan up


Penggunaan php artisan down memang praktis, tapi itu menutup tampilan untuk semua user.
Agar kita sebagai admin tetap bisa mengaksesnya, tambah kode rahasia dengan flag --secret.
Sebagai contoh saya ingin membuat kode rahasia "uncover", maka jalankan perintah:
php artisan down --secret="uncover"

Selanjutnya, buka alamat URL homepage dengan tambahan "/uncover", yakni:
http://localhost:8000/uncover. Dalam praktek ini bisa saja tampil halaman 404 karena saya
sudah menghapus route "/" bawaan laravel. Tapi itu tidak masalah, begitu halaman
http://localhost:8000/uncover diakses sekali, Laravel akan membuat session di web
browser. 
