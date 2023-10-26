<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Students;
use App\Models\Lecturer;
use App\Models\Partner;
use App\Models\Mbkm;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            // 'remember_token' => Str::random(10),
        ]);
        Students::create([
            'name' => 'student',
            'address' => '123 Main Street',
            'phone' => '1234567890',
            'nim' => '123456789',
            'email' => 'student@gmail.com',
            'username' => 'student',
            'password' => Hash::make('123'),
        ]);
        Lecturer::insert([
            'lecturer_name' => 'John Doe',
            'address' => '123 Example Street, City',
            'phone' => '1234567890',
            'nip' => '12345678',
            'email' => 'johndoe@example.com',
            'username' => 'johndoe',
            'password' => Hash::make('password'),
            'status' => 'dosen pembimbing',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Partner::insert([
            'partner_name' => 'Example Partner',
            'address' => '456 Sample Avenue, City',
            'phone' => '9876543210',
            'email' => 'partner@example.com',
            'status' => 'pending',
            'jenis_mitra' => 'luar kampus',
            'username' => 'partneruser',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Mbkm::insert([
            'partner_id' => 1, // Ganti dengan ID partner yang sesuai
            'program_name' => 'Contoh Program',
            'capacity' => 100,
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'info' => 'Informasi tambahan tentang program',
            'status_acc' => 'pending',
            'is_active' => 'inactive',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}