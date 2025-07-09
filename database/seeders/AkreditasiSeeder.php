<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kriteria;
use App\Models\SubKriteria;

class AkreditasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Kriteria::truncate();
        SubKriteria::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            'C1' => ['nama' => 'Visi, Misi, Tujuan, dan Strategi', 'sub' => ['Renstra polbeng', 'Dokumen visi dan misi program studi', 'Bukti pelaksanaan strategi', 'Evaluasi dan revisi visi dan misi']],
            'C2' => ['nama' => 'Tata Pamong, Kepemimpinan, Sistem Pengelolaan, dan Penjaminan Mutu', 'sub' => ['Struktur organisasi program studi', 'SK (Surat Keputusan) pimpinan', 'Manual mutu dan SOP (Standart Operating Procedure)', 'Laporan penjaminan mutu', 'Evaluasi diri dan laporan kinerja', 'Bukti rapat dan Keputusan tata pamong']],
            'C3' => ['nama' => 'Mahasiswa', 'sub' => ['Data penerimaan mahasiswa (profil, jumlah, dll.)', 'Pedoman akademik dan kemahasiswaan', 'Laporan kegiatan mahasiswa (ekstrakurikuler, prestasi, dll.)', 'Dokumentasi layanan bimbingan dan konseling', 'Hasil survei kepuasaan mahasiswa']],
            'C4' => ['nama' => 'Sumber Daya Manusia (Dosen dan Tenaga Kependidikan)', 'sub' => ['Data dosen', 'Data tenaga kependidikan', 'Sertifikat Pendidikan dan pelatihan', 'Laporan pengembangan professionalisme dosen dan tenaga kependidikan', 'Evaluasi kinerja dosen dan tenaga kependidikan', 'Bukti partisipasi dosen dalam seminar/workshop']],
            'C5' => ['nama' => 'Kurikulum, Pembelajaran, dan Suasana Akademik', 'sub' => ['Dokumen kurikulum (struktur, mata kuliah, deskripsi, dll.)', 'Rencana pembelajaran semester (RPS)', 'Evaluasi proses pembelajaran', 'Bukti kegiatan akademik dan suasana akademik yang mendukung', 'Hasil survey kepuasaan mahasiswa terhadap kurikulum dan pembelajaran']],
            'C6' => ['nama' => 'Pembiayaan, Sarana, dan Prasarana', 'sub' => ['Rencana anggaran dan pendapatan belanja', 'Bukti penggunaan dana', 'Daftar inventaris sarana dan prasarana (laboratorium, perpustakaan, dll.)', 'Laporan pemeliharaan fasilitas', 'Bukti investasi dalam pengembangan saran dan prasarana']],
            'C7' => ['nama' => 'Penelitian', 'sub' => ['Data penelitian yang dilakukan oleh dosen dan mahasiswa', 'Laporan kegiatan penelitian dan hasilnya', 'Publikasi hasil penelitian (jurnal,konferensi, dll.)', 'Bukti dukungan program studi terhadap penelitian (pendanaan, fasilitas, dll.)', 'Hasil survey kepuasan dosen dan mahasiswa terhadap kegiatan penelitian']],
            'C8' => ['nama' => 'Pengabdian kepada Masyarakat', 'sub' => ['Data kegiatan pengabdian kepada masyarakat', 'Laporan kegiatan dan dampaknya terhadap Masyarakat', 'Bukti dukungan program studi terhadap Masyarakat', 'Bukti dukungan program studi terhadap pengabdian Masyarakat (pendanaan, fasilitas, dll.)', 'Kerjasam dengan pihak eksternal untuk kegiatan pengabdian', 'Hasil survei kepuasan Masyarakat terhadap kegiatan pengabdian']],
            'C9' => ['nama' => 'Luaran dan Capaian Lulusan', 'sub' => ['Data lulusan (jumlah, waktu tunggu kerja, pekerjaan, dll.)', 'Hasil tracer study (studi pelacakan lulusan)', 'Bukti prestasi lulusan (penghargaan, sertifikasi, dll.)', 'Evaluasi Tingkat kelulusan dan konstribusi lulusan terhadap Masyarakat', 'Hasil survey kepuasan pengguna lulusan (Perusahaan, instansi, dll.).']],
        ];

        foreach ($data as $kode => $item) {
            $kriteria = Kriteria::create([
                'kode' => $kode,
                'nama' => $item['nama'],
            ]);

            foreach ($item['sub'] as $subNama) {
                SubKriteria::create([
                    'kriteria_id' => $kriteria->id,
                    'nama' => $subNama,
                ]);
            }
        }
    }
}