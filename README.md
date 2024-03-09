# Dokumentasi
Langkah-langkah berikut akan membantu Anda menjalankan proyek Laravel ini dengan benar:

1. **Instalasi Dependencies menggunakan Composer:**
    ```bash
    composer install
    ```
    Pastikan bahwa Composer terpasang di sistem Anda sebelum menjalankan perintah ini.

2. **Verifikasi Ketersediaan File Environment (.env):**
    Pastikan bahwa file `.env` sudah ada di dalam proyek dan telah dikonfigurasi dengan benar, termasuk konfigurasi database dan pengaturan lainnya.

3. **Migrasi Database dan Pengisian Data Awal:**
    ```bash
    php artisan migrate:fresh --seed
    ```
    Gunakan perintah di atas untuk menjalankan migrasi database dan mengisi data awal. Ini akan memastikan struktur database proyek Anda terbentuk dengan benar dan data awal diisi.
