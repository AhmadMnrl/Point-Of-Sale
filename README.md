# Point Of Sale POS

website untuk kasir dan managemnt barang

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal wesbite POS:

1. **Kloning Repository**

   ```bash
   git clone https://github.com/AhmadMnrl/Point-Of-Sale.git
2. **Instal Dependensi**

   ```bash
   composer install
3. **Salin File Konfigurasi**

   ```bash
   cp .env.example .env
4. **Generate Key Aplikasi**

   ```bash
   php artisan key:generate
5. **Jalankan Migrasi Database Serta Seeder**

   ```bash
   php artisan migrate --seed
6. **Jalankan Server**

   ```bash
   php artisan serve
7. **Akses Aplikasi**
   ```bash
   Buka http://localhost:8000 di browser Anda.


NOTE : sample user ada didalam file AllDataSeeder.php

