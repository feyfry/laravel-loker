<?php

namespace App\Exports;

use App\Models\Lamaran;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;

class LamaranExport implements FromCollection, WithHeadings, WithDefaultStyles, ShouldAutoSize
{

    protected $start_date, $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Lamaran::whereBetween('created_at', [$this->start_date, $this->end_date])->get()->map(function ($Lamaran, $index) {
            return [
                $index + 1,
                $Lamaran->applicant->profile->full_name,
                $Lamaran->applicant->profile->date_of_birth,
                $Lamaran->applicant->profile->phone_number,
                $Lamaran->applicant->profile->address,
                $Lamaran->jobdesc->title,
                $Lamaran->jobdesc->company_name,
                $Lamaran->jobdesc->position,
                $Lamaran->jobdesc->type,
                $Lamaran->created_at->format('d-m-Y H:i'),
                $Lamaran->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Pelamar',
            'Tanggal Lahir:',
            'No.HP:',
            'Alamat:',
            'Posisi Pekerjaan',
            'Perusahaan',
            'Bidang',
            'Tipe Pekerjaan',
            'Tanggal Melamar',
            'Status',
        ];
    }

    public function defaultStyles(Style $defaulStyle)
    {
        return $defaulStyle->getFill()->setFillType(Fill::FILL_SOLID);

        return [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => Color::COLOR_RED,
                ],
            ],
        ];
    }
}
