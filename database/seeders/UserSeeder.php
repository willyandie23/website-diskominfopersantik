<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $admin = User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@katingankab.go.id',
        //     'password' => Hash::make('12345678'),
        //     'remember_token' => Str::random(10),
        // ]);
        // $admin->assignRole('admin');

        // $superadmin = User::create([
        //     'name' => 'superadmin',
        //     'email' => 'superadmin@katingankab.go.id',
        //     'password' => Hash::make('12345678'),
        //     'remember_token' => Str::random(10),
        // ]);
        // $superadmin->assignRole('superadmin');
        
        $pkp = User::create([
            'name' => 'Bidang PKP',
            'email' => 'pkp@diskominfosantik.go.id',
            'password' => Hash::make('Kominfo@2026!'),
            'remember_token' => Str::random(10),
        ]);
        $pkp->assignRole('admin');
        
        $operator = User::create([
            'name' => 'Bram',
            'email' => 'operator@diskominfosantik.go.id',
            'password' => Hash::make('Kominfo@2026!'),
            'remember_token' => Str::random(10),
        ]);
        $operator->assignRole('admin');
        
        $denny = User::create([
            'name' => 'Denny',
            'email' => 'denny@diskominfosantik.go.id',
            'password' => Hash::make('Kominfo@2026!'),
            'remember_token' => Str::random(10),
        ]);
        $denny->assignRole('admin');
        
        $rendy = User::create([
            'name' => 'Rendy',
            'email' => 'rendy@diskominfosantik.go.id',
            'password' => Hash::make('Kominfo@2026!'),
            'remember_token' => Str::random(10),
        ]);
        $rendy->assignRole('admin');
        
        $rina = User::create([
            'name' => 'Rina',
            'email' => 'rina@diskominfosantik.go.id',
            'password' => Hash::make('Kominfo@2026!'),
            'remember_token' => Str::random(10),
        ]);
        $rina->assignRole('admin');

        $bidang_ti = User::create([
            'name' => 'Bidang TI',
            'email' => 'bidang_ti@diskominfosantik.go.id',
            'password' => Hash::make('Kominfo@2026!'),
            'remember_token' => Str::random(10),
        ]);
        $bidang_ti->assignRole('admin');
    }
}
