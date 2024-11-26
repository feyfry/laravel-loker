<?php

namespace App\Reports;

use App\Models\InterviewSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class InterviewPDFReport
{
    protected $start_date;
    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function generate()
    {
        try {
            // Get data dengan query created_at
            $interviews = InterviewSchedule::query()
                ->whereDate('created_at', '>=', $this->start_date)
                ->whereDate('created_at', '<=', $this->end_date)
                ->with(['application.jobdesc', 'application.applicant.profile'])
                ->orderBy('created_at', 'desc')
                ->get();

            // Hitung summary
            $total_interviews = $interviews->count();
            $scheduled = $interviews->where('status', 'scheduled')->count();
            $completed = $interviews->where('status', 'completed')->count();
            $cancelled = $interviews->where('status', 'cancelled')->count();

            // Create PDF
            $pdf = App::make('dompdf.wrapper');
            $pdf->getDomPDF()->set_option('enable-php', true);
            $pdf->getDomPDF()->set_option('isPhpEnabled', true);
            $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);

            // Load view
            $pdf->loadView('backend.reports.interviews', [
                'interviews' => $interviews,
                'start_date' => Carbon::parse($this->start_date)->format('d/m/Y'),
                'end_date' => Carbon::parse($this->end_date)->format('d/m/Y'),
                'total_interviews' => $total_interviews,
                'scheduled' => $scheduled,
                'completed' => $completed,
                'cancelled' => $cancelled,
            ]);

            return $pdf;
        } catch (\Exception $error) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $error->getMessage());
        }
    }
}
