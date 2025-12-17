<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pegawai')->insert([
            [
                'id_kelurahan' => 1,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10001',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 1,
                'id_jabatan' => 2, // seklur
                'nama' => 'A.Idham Syah, ST',
                'nip' => '19841220 200901 1 001',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 1,
                'id_jabatan' => 3, // lurah
                'nama' => 'Nurhaya, S.Sos',
                'nip' => '19690709 200701 2 021',
                'password' => Hash::make('196907092007012021'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 2,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10002',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 2,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10003',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 2,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10004',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 3,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10005',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 3,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10006',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 3,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10007',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 4,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10008',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 4,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10009',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 4,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10010',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 5,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10011',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 5,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10012',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 5,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10013',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 6,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10014',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 6,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10015',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 6,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10016',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 7,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10017',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 7,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10018',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 7,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10019',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 8,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10020',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 8,
                'id_jabatan' => 2, // seklur
                'nama' => 'M. Jur',
                'nip' => '19770303 200701 1 019',
                'password' => Hash::make('197703032007011019'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 8,
                'id_jabatan' => 3, // lurah
                'nama' => 'H. Nur Akbar, SE',
                'nip' => '19820811 200604 1 009',
                'password' => Hash::make('198208112006041009'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 9,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10021',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 9,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10022',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 9,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10023',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 10,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '123456',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 10,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10025',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 10,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10026',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 11,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10027',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 11,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10028',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 11,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10029',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 12,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10030',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 12,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10031',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 12,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10032',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 13,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10033',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 13,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10034',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 13,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10035',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 14,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10036',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 14,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10037',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 14,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10038',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 15,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10039',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 15,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10040',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 15,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10041',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 16,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10042',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 16,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10043',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 16,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10044',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 18,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10045',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 18,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10046',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 18,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10047',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 19,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10048',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 19,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10049',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 19,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10050',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 20,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10051',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 20,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10052',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 20,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10053',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 21,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10054',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 21,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10055',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 21,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10056',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 22,
                'id_jabatan' => 1, // pelayan
                'nama' => 'Pegawai Pelayan',
                'nip' => '10057',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 22,
                'id_jabatan' => 2, // seklur
                'nama' => 'Pegawai Seklur',
                'nip' => '10058',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelurahan' => 22,
                'id_jabatan' => 3, // lurah
                'nama' => 'Pegawai Lurah',
                'nip' => '10059',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
