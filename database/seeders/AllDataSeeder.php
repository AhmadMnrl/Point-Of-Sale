<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;

class AllDataSeeder extends Seeder
{
    public function run()
    {
        // Seed Users
        User::create([
            'kode' => 'A-202407100001',
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'), // Set a default password
            'level' => 'admin',
        ]);

        User::create([
            'kode' => 'K-202407100001',
            'nama' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('password123'),
            'level' => 'kasir',
        ]);

        // Seed Kategori
        Kategori::create(['nama' => 'Shampoo']);
        Kategori::create(['nama' => 'Conditioner']);
        Kategori::create(['nama' => 'Soap']);
        Kategori::create(['nama' => 'Toothpaste']);
        Kategori::create(['nama' => 'Body Wash']);

        // Seed Satuan
        Satuan::create(['nama' => 'Pcs']);
        Satuan::create(['nama' => 'Bottle']);
        Satuan::create(['nama' => 'Box']);
        Satuan::create(['nama' => 'Pack']);
        Satuan::create(['nama' => 'Kg']);

        // Seed Barang
        Barang::create([
            'kode' => '20247100001',
            'nama' => 'Zinc',
            'kategori_id' => 1, // Assuming 'Shampoo' has ID 1
            'harga_beli' => 10000.00,
            'harga_jual' => 12000.00,
            'satuan_id' => 1, // Assuming 'Pcs' has ID 1
            'stok' => 100,
            'diskon' => 5.00,
        ]);

        Barang::create([
            'kode' => '20247100002',
            'nama' => 'Pantene Conditioner',
            'kategori_id' => 2, // Assuming 'Conditioner' has ID 2
            'harga_beli' => 15000.00,
            'harga_jual' => 18000.00,
            'satuan_id' => 2, // Assuming 'Bottle' has ID 2
            'stok' => 200,
            'diskon' => 10.00,
        ]);

        // Add more barang entries if needed
    }
}
