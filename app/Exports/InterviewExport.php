<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\InterviewSchedule;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;

class InterviewExport implements FromCollection, WithHeadings, WithDefaultStyles, ShouldAutoSize
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
        return InterviewSchedule::query()
        ->whereDate('created_at', '>=', $this->start_date)
        ->whereDate('created_at', '<=', $this->end_date)
        ->with(['application.jobdesc', 'application.applicant.profile'])
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($interview, $index) {
            return [
                $index + 1,
                $interview->application->applicant->profile->full_name ?? 'N/A',
                $interview->application->jobdesc->title ?? 'N/A',
                $interview->application->jobdesc->company_name ?? 'N/A',
                Carbon::parse($interview->interview_date)->format('d-m-Y H:i'),
                $interview->interview_method,
                $interview->interview_location ?? '-',
                $interview->interviewer_name,
                $interview->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Pelamar',
            'Posisi',
            'Perusahaan',
            'Tanggal Interview',
            'Metode Interview',
            'Lokasi',
            'Interviewer',
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
