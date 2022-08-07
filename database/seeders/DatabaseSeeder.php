<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\matakuliah;
use App\Models\Dosen; 
use App\Models\semester; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Mahasiswa::factory(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'dosen1',
                'email' => 'dosen1@gmail.com',
                'role' => 'dosen',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'dosen2',
                'email' => 'dosen2@gmail.com',
                'role' => 'dosen',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'dosen3',
                'email' => 'dosen3@gmail.com',
                'role' => 'dosen',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'mahasiswa1',
                'email' => 'mahasiswa1@gmail.com',
                'role' => 'mahasiswa',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'mahasiswa2',
                'email' => 'mahasiswa2@gmail.com',
                'role' => 'mahasiswa',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'mahasiswa3',
                'email' => 'mahasiswa3@gmail.com',
                'role' => 'mahasiswa',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'mahasiswa4',
                'email' => 'mahasiswa4@gmail.com',
                'role' => 'mahasiswa',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'mahasiswa5',
                'email' => 'mahasiswa5@gmail.com',
                'role' => 'mahasiswa',
                'password' => bcrypt('12345678')
            ],
        ]; 
        User::insert($user);


        $dosen = [
            [
                'nama' => 'dosen1',
                'email' => 'dosen1@gmail.com', 
            ],
            [
                'nama' => 'dosen2',
                'email' => 'dosen2@gmail.com', 
            ],
            [
                'nama' => 'dosen3',
                'email' => 'dosen3@gmail.com', 
            ],
        ]; 
        dosen::insert($dosen);


        $mahasiswa = [
            [
                'nama_mahasiswa' => 'mahasiswa1',
                'alamat' => 'crb',
                'no_tlp' => '08111',
                'email' => 'mahasiswa1@gmail.com',
            ],
            [
                'nama_mahasiswa' => 'mahasiswa2',
                'alamat' => 'jkt',
                'no_tlp' => '08222',
                'email' => 'mahasiswa2@gmail.com',
            ],
            [
                'nama_mahasiswa' => 'mahasiswa3',
                'alamat' => 'bdg',
                'no_tlp' => '08333',
                'email' => 'mahasiswa3@gmail.com',
            ],
            [
                'nama_mahasiswa' => 'mahasiswa4',
                'alamat' => 'kuningan',
                'no_tlp' => '08444',
                'email' => 'mahasiswa4@gmail.com',
            ],
            [
                'nama_mahasiswa' => 'mahasiswa5',
                'alamat' => 'majalengka',
                'no_tlp' => '08555',
                'email' => 'mahasiswa5@gmail.com',
            ],
        ]; 
        mahasiswa::insert($mahasiswa);


        $semester = [
            [
                'semester' => '2022 - Semester 1', 
            ],
            [
                'semester' => '2022 - Semester 3', 
            ],
            [
                'semester' => '2022 - Semester 5', 
            ], 
            [
                'semester' => '2022 - Semester 7', 
            ],  
        ];
        semester::insert($semester); 

        $matakuliah = [
            [
                'nama_matakuliah' => 'Kalkulus',
                'dosen_id' => '1',  
                'sks' => '2',   
            ],
            [
                'nama_matakuliah' => 'Algoritma Pemograman',
                'dosen_id' => '1',  
                'sks' => '3',   
            ],
            [
                'nama_matakuliah' => 'Aritmatika Linier',
                'dosen_id' => '2',  
                'sks' => '4',    
            ], 
            [
                'nama_matakuliah' => 'Sistem Pakar',
                'dosen_id' => '3',  
                'sks' => '3',   

            ],
            
        ]; 
        matakuliah::insert($matakuliah);
    }
}
