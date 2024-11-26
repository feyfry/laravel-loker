<?php

namespace App\Reports;

use Carbon\Carbon;
use App\Models\Lamaran;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;


class LamaranPDFReport
{
    protected $start_date;
    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = Carbon::parse($start_date)->startOfDay();
        $this->end_date = Carbon::parse($end_date)->endOfDay();
    }

    public function generate()
    {
        try {
            // Get data
            $lamarans = Lamaran::whereBetween('created_at', [
                $this->start_date,
                $this->end_date
            ])
            ->with(['jobdesc', 'applicant.profile'])
            ->get();

            // Calculate summaries for header
            $total_lamaran = $lamarans->count();
            $pending = $lamarans->where('status', 'pending')->count();
            $accepted = $lamarans->where('status', 'accepted')->count();
            $rejected = $lamarans->where('status', 'rejected')->count();

            // Create PDF
            $pdf = App::make('dompdf.wrapper');

            // Set options
            $pdf->getDomPDF()->set_option('enable-php', true);
            $pdf->getDomPDF()->set_option('isPhpEnabled', true);
            $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);

            // Set paper
            $pdf->setPaper('A4', 'portrait');

            // Load view with data
            $pdf->loadView('backend.reports.applications', [
                'lamarans' => $lamarans,
                'start_date' => $this->start_date->format('d/m/Y'),
                'end_date' => $this->end_date->format('d/m/Y'),
                'total_lamaran' => $total_lamaran,
                'pending' => $pending,
                'accepted' => $accepted,
                'rejected' => $rejected,
            ]);

            return $pdf;

        } catch (\Exception $error) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $error->getMessage());
        }
    }
}
