# Point Of Sale POS

website untuk kasir dan managemnt barang

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal wesbite POS:

1. **Kloning Repository**

   ```bash
   git clone https://github.com/AhmadMnrl/Point-Of-Sale.git
1. **Instal Dependensi**

   ```bash
   composer install
1. **Salin File Konfigurasi**

   ```bash
   cp .env.example .env
1. **Generate Key Aplikasi**

   ```bash
   php artisan key:generate
1. **KJalankan Migrasi Database Serta Seeder**

   ```bash
   php artisan migrate --seed
1. **Jalankan Server**

   ```bash
   php artisan serve
1. **KAkses Aplikasi**

Buka http://localhost:8000 di browser Anda.


NOTE : sample user ada didalam file AllDataSeeder.php

