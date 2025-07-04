<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel terlebih dahulu untuk menghindari duplikasi
        DB::table('ruangans')->truncate();

        $ruangans = [
            'Poli Penyakit Dalam', 'Poli Paru', 'Poli Jantung', 'Poli Saraf', 'Poli Bedah',
            'Poli Orthopedi', 'Poli Urologi', 'Poli Kandungan', 'Poli Anak', 'Poli THT',
            'Poli Mata', 'Poli Kulit dan Kelamin', 'Poli Gigi', 'Poli Fisioterapi', 'Poli Umum',
            'IGD', 'Rawat Inap', 'ICU / HCU', 'Perinatologi', 'Kamar Operasi',
            'Laboratorium', 'Radiologi', 'Farmasi', 'Gizi', 'Rekam Medis',
            'Keuangan', 'Personalia', 'Marketing', 'IT', 'Umum dan Rumah Tangga',
            'Security', 'Driver', 'Cleaning Service', 'Loundry', 'Kantin',
            'Koperasi', 'Manajemen', 'Direksi', 'Komite Medik', 'Komite Keperawatan',
            'SPI (Satuan Pengawas Internal)', 'KPRS (Keselamatan Pasien Rumah Sakit)',
            'PPI (Pencegahan dan Pengendalian Infeksi)', 'PKRS (Promosi Kesehatan Rumah Sakit)',
            'Humas', 'Casemix', 'Pendaftaran', 'Kasir', 'Informasi',
            'Customer Service', 'Rawat Jalan', 'Hemodialisa', 'Endoscopy', 'Medical Check Up (MCU)',
            'Kesehatan Lingkungan', 'IPSRS (Instalasi Pemeliharaan Sarana Rumah Sakit)',
            'CSSD (Central Sterile Supply Department)', 'Bank Darah', 'Ambulance',
            'Pemulasaran Jenazah', 'Logistik Umum', 'Logistik Farmasi', 'Administrasi Rawat Inap',
            'Administrasi Rawat Jalan', 'Administrasi IGD', 'Poli Akupuntur', 'Poli Gizi Klinik',
            'Poli Psikologi', 'Poli Tumbuh Kembang', 'Poli VCT', 'Rehabilitasi Medik',
            'Terapi Wicara', 'Okupasi Terapi', 'Poli Eksekutif', 'Poli Geriatri',
            'Poli Kosmetik Medik', 'Poli Andrologi', 'Poli Onkologi', 'Poli Paliatif',
            'Poli DOTS TB', 'Kamar Bersalin', 'Nifas', 'Ruang Isolasi', 'Ruang Kemoterapi',
            'Ruang Radioterapi', 'Patologi Anatomi', 'Patologi Klinik', 'Mikrobiologi',
            'Sitogenetika', 'Forensik', 'Kardiologi Intervensi', 'Bedah Saraf',
            'Bedah Plastik', 'Bedah Anak', 'Bedah Vaskuler', 'Bedah Onkologi',
            'Bedah Digestif', 'Konsultan Ginjal Hipertensi', 'Konsultan Alergi Imunologi',
            'Konsultan Endokrinologi', 'Konsultan Gastroenterohepatologi',
            'Konsultan Geriatri', 'Konsultan Hematologi Onkologi Medik',
            'Konsultan Penyakit Tropik Infeksi', 'Konsultan Psikosomatik',
            'Konsultan Reumatologi', 'Gudang', 'Arsip', 'Dapur', 'Sanitasi',
            'Kesekretariatan', 'Diklat', 'Penelitian dan Pengembangan', 'Perpustakaan',
            'Binrohtal (Bimbingan Rohani dan Mental)', 'Komite Etik dan Hukum',
            'Tim Penanggulangan Bencana', 'Tim K3RS (Kesehatan dan Keselamatan Kerja Rumah Sakit)',
            'Tim HIV/AIDS', 'Tim PONEK (Pelayanan Obstetri Neonatal Emergensi Komprehensif)',
            'Tim PPRA (Program Pengendalian Resistensi Antimikroba)', 'Pusat Komando',
            'Pusat Sterilisasi', 'Unit Transfusi Darah', 'Poli Fertilitas',
            'Poli Laktasi', 'Poli Nyeri', 'Poli Tidur', 'Poli Vaksinasi'
        ];

        foreach ($ruangans as $ruangan) {
            Ruangan::create(['nama_ruangan' => $ruangan]);
        }
    }
}