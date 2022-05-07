<p align="center"><a href="" target="_blank"><img src="https://user-images.githubusercontent.com/68214221/167259266-ebf72cd7-d495-4d04-b91f-d98c4fab4e55.png" width="400"></a></p>

## DEFINISI APLIKASI RESERVASI HOTEL HEBAT

Hotel merupakan tempat untuk bermalam jika pergi ke tempat yang cukup jauh dan memakan waktu lebih dari sehari, namun sebelum bermalam diperlukan reservasi atau boking kamar hotelnya terlebih dahulu. Di zaman digital seperti ini reservasi kamar hotel akan menjadi lebih mudah jika menggunakan web aplikasi khusus untuk melakukan reservasi kamar.

Hotel hebat menerapkan web aplikasi reservasi kamar hotel yang bertujuan untuk memudahkan pemesanan kamar di tanggal tertentu dan dengan jumlah kamar yang tersedia secara real time.

## MASALAH ATAU TANTANGAN

Web Aplikasi reservasi hotel hebat dibuat untuk memudahkan pemesanan kamar bagi para konsumen maupun karyawan hotel hebat itu sendiri, dengan adanya aplikasi ini hotel hebat yakin kedepanya akan semakin mudah dan efesien dalam melakukan pemesanan kamar. Namun dalam proses pembuatan nya terdapat beberapa tantangan dan masalah.

Tantangan yang didapatkan saat mengerjakan project ini adalah :

-   melakukan research dan interview orang lain untuk kebutuhan aplikasi ini
-   sulit nya membuat fitur cek kamar dengan banyak cara pemesanan
-   membuat fitur kirim email untuk semua pemesanan pending, check-in, check-out dan batal

## SOLUSI

Solusi dari tantangan yang dihadapi adalah :

-   menentukan orang tertentu yang diharapapkan paling membantu dalam aplikasi ini, ini bertujuan agar aplikasi menjadi lebih ter arah dan tidak ada pemasukan yang keliru.
-   melakukan research dan mencoba dengan cara sendiri membuat fitur tersebut
-   Dalam membuat fitur kirim email solusi nya dengan mencari cara membuat fitur ini melalui kanal youtube dan dokumentasi framework yang digunakan(dalam kasus ini menggunakan laravel 9)

## PROSES PEMBUATAN

Selengkapnya di portofolio :

## ALUR PROGRAM PEMESANAN KAMAR

Selengkapnya di portofolio :

## CARA MENGGUNAKAN APLIKASI PEMESANAN KAMAR HOTEL HEBAT

Aplikasi ini dibuat menggunakan framework laravel 9, jadi jika ingin menggunakan aplikasi ini hal yang diperlukan adalah :

1. terinstall composer versi terbaru
2. terinstall laravel versi 9 (dengan catatan port phpmyadmin sudah berubah menjadi 8080)
3. terinstall xampp atau sejenisnya
4. terinstall php versi 8

Lalu untuk cara menggunakanya ikuti langkah berikut :

-   download project ini lalu simpan di htdocs local kalian
-   lalu buka project ini di kode editor favorit kalian
-   rename file .env.exampple menjadi .env
-   buka file .env.example lalu ubah isi pada bagian "DB_DATABASE" menjadi "hotel_hebat" tetapi kalian harus membuat databasenya terlebih dahulu di phpmyadmin
-   setelahnya ubah isi pada bagian "MAIL_USERNAME" dan "MAIL_PASSWORD" dengan email dan password kalian ataupun email hotel yang ingin menggunakan aplikasi ini
-   setelah itu buka terminal kalian yang sudah mengarah di project ini
-   lalu ketikan "php artisan migrate:fresh --seed" tanpa tanda kutip dua di terminal kalian
-   masih di terminal ketikan kembali "php artisan storage:link" tanpa tanda kutip dua lalu enter
-   jika sampai sini kalian tidak ada masalah maka aplikasi sudah siap digunakan

Lalu untuk menjalankan aplikasi nya dengan cara berikut :

-   buka terminal yang sudah mengarah di project ini
-   lalu ketikan "php artisan serve" tanpa tanda kutip dua
-   setelah itu copy url yang muncul "http://127.0.0.1:8000/" biasanya itu yang akan tertulis
-   lalu pastekan url tersebut di browser yang kalian suka lalau klik enter

## FITUR YANG ADA DI APLIKASI RESERVASI HOTEL HEBAT

Fitur yang terdapat pada aplikasi ini diantaranya :

### ADMINISTRATOR

<img src="https://user-images.githubusercontent.com/68214221/167260281-0c1a8aa3-bc65-467d-84ba-c5f245a10cf3.png" width="500">

Administrator dapat mengelola :

1. Login dengan cara ketik di url "http://127.0.0.1:8000/login"
   <img src="https://user-images.githubusercontent.com/68214221/167260912-979f2157-5490-4b3d-8aa5-356d6ed248e7.png" width="500">

2. Melakukan CRUD(Create, Read, Update dan Delete) pada Tipe Kamar
   <img src="https://user-images.githubusercontent.com/68214221/167260309-bb4e3499-4c4f-47a1-bb88-cc046f10d9bf.png" width="500">

3. Melakukan CRUD(Create, Read, Update dan Delete) pada Fasilitas Kamar
   <img src="https://user-images.githubusercontent.com/68214221/167260308-bd2549d3-1f26-41fa-a647-73a3fc11a556.png" width="500">

4. Melakukan CRUD(Create, Read, Update dan Delete) pada Fasilitas Hotel
   <img src="https://user-images.githubusercontent.com/68214221/167260306-3b5022c6-e0d5-4f79-8621-c0486b64cd66.png" width="500">

kalian bisa mencoba nya sendiri untuk fitur admin ini

### RESEPSIONIS

<img src="https://user-images.githubusercontent.com/68214221/167260695-663dfa0d-2225-4c73-98a5-bc4964ecfcf1.png" width="500">

Resepsionis dapat mengelola :

1. Login dengan cara ketik di url "http://127.0.0.1:8000/login"
   <img src="https://user-images.githubusercontent.com/68214221/167260912-979f2157-5490-4b3d-8aa5-356d6ed248e7.png" width="500">

2. Melakukan filtering data berdasarkan tanggal check-in dan nama tamu. Serta dapat melakukan check-in kamar yang sudah dipesan dan dapat melakukan pembatalan pesan.
   <img src="https://user-images.githubusercontent.com/68214221/167260698-b6b7f038-065e-434c-b5e1-afb97c753f54.png" width="500">

3. Melihat nota reservasi pada tombol "lihat" dan tampilan nya seperti ini jika di klik.
   <img src="https://user-images.githubusercontent.com/68214221/167260781-a607e447-e1f6-4867-b32b-18c267294aef.png" width="500">

Resepsionis tidak mengatur check-out reservasi karena fitur chekc-out sudah dibuat otomatis oleh sistem.
Jika hari ini sama dengan hari check-out maka status reservasi akan berubah menjadi "check-out" secara otomatis selama halaman itu di refresh.

### USER ATAU KONSUMEN

<img src="https://user-images.githubusercontent.com/68214221/167260695-663dfa0d-2225-4c73-98a5-bc4964ecfcf1.png" width="500">

User atau Konsumen dapat melakukan :

1. Melihat Homepage Web Aplikasi
   <img src="https://user-images.githubusercontent.com/68214221/167260914-0a994046-3d0d-4fc0-82c0-ada0a30de3fe.png" width="500">

2. Melihat tipe kamar dan fasilitasnya
   <img src="https://user-images.githubusercontent.com/68214221/167260917-1ce53f31-c128-4f30-8a0c-927b2aa1c527.png" width="500">

3. Melihat fasilitas hotel
   <img src="https://user-images.githubusercontent.com/68214221/167260910-2f48aefb-2aaf-4dce-a245-15a9675c2352.png" width="500">

4. Melakukan Pemesanan kamar hotel hebat
   <img src="https://user-images.githubusercontent.com/68214221/167260915-f185eea6-0859-4ff6-afc3-ea5421adfe92.png" width="500">

## KONTAK

Jika ada yang ingin ditambahkan atau dikoreksi bisa hubungi saya ke email yang berada di portofolio ya!

Arigatou. :)

🔥 TERIMAKASIH 🔥
Terimakasih untuk kalian yang udah mampir kesini, semoga mempelajari sesuatu! ❤️
