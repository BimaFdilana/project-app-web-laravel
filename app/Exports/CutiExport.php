<?php

namespace App\Exports;

use App\Models\Cuti;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border; // <-- Import Border style
use PhpOffice\PhpSpreadsheet\Style\Fill;   // <-- Import Fill style

class CutiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $nama;
    protected $bulan;
    protected $tahun;
    private $rowNumber = 0;

    public function __construct($nama = null, $bulan = null, $tahun = null)
    {
        $this->nama = $nama;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $query = Cuti::query();

        if ($this->nama) {
            $query->where('nama', 'like', '%' . $this->nama . '%');
        }
        if ($this->bulan) {
            $query->whereMonth('tanggal_cuti', $this->bulan);
        }
        if ($this->tahun) {
            $query->whereYear('tanggal_cuti', $this->tahun);
        }

        return $query->orderBy('tanggal_cuti', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Ruangan / Bagian',
            'Tanggal Cuti',
            'Jumlah Cuti',
            'Keperluan Cuti',
            'Keterangan',
        ];
    }

    public function map($cuti): array
    {
        $this->rowNumber++;
        $tanggalCuti = $cuti->tanggal_cuti->format('d/m/Y') . ' - ' . $cuti->tanggal_akhir_cuti->format('d/m/Y');

        return [
            $this->rowNumber,
            $cuti->nama,
            $cuti->ruangan,
            $tanggalCuti,
            $cuti->jumlah_cuti,
            $cuti->keperluan_cuti,
            $cuti->keterangan,
        ];
    }


    /**
     * Menerapkan style ke sheet.
     */
    public function styles(Worksheet $sheet)
    {
        // Mengatur tinggi baris untuk heading
        $sheet->getRowDimension(1)->setRowHeight(32);

        // Mengambil range data dari sel A1 sampai kolom dan baris terakhir
        $cellRange = 'A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow();

        return [
            // Style baris pertama (heading)
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'ded9c3'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],

            // ===============================================
            // STYLE BARU: Tambahkan border ke seluruh tabel
            // ===============================================
            $cellRange => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],
        ];
    }
}
