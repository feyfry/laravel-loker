<?php

namespace App\Http\Controllers\Backend;

use App\Exports\InterviewExport;
use App\Http\Controllers\Controller;
use App\Models\InterviewSchedule;
use App\Models\Lamaran;
use App\Models\Notification;
use App\Reports\InterviewPDFReport;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JadwalInterviewController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$request->user()->isAdmin()) {
                abort(403, 'Unauthorized action.');
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $interviews = InterviewSchedule::with(['application.applicant.profile', 'application.jobdesc'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('backend.jadwal-interview.index', [
            'interviews' => $interviews,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil lamaran yang sudah diterima (accepted) dan belum dijadwalkan interviewnya
        $accepted_applications = Lamaran::with(['applicant.profile', 'jobdesc'])
            ->where('status', 'accepted')
            ->whereDoesntHave('interviewSchedule')
            ->get(); // Ambil semua pelamar yang diterima (accepted)

        return view('backend.jadwal-interview.create', [
            'applications' => $accepted_applications,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'interview_date' => 'required|date',
            'interview_method' => 'required|in:online,offline',
            'interview_location' => 'nullable|string',
            'interviewer_name' => 'required|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,completed,cancelled',
        ]);

        try {
            // Buat interview schedule dan simpan ke variabel
            $interview = InterviewSchedule::create($validatedData);

            // Load relasi yang diperlukan
            $interview->load('application.applicant');

            // Buat notifikasi untuk pelamar
            Notification::create([
                'user_id' => $interview->application->applicant->id,
                'title' => 'Jadwal Interview',
                'message' => "Anda telah dijadwalkan untuk interview pada " . Carbon::parse($interview->interview_date)->format('d F Y H:i'),
                'type' => 'interview',
                'data' => [
                    'interview_id' => $interview->id,
                    'date' => $interview->interview_date,
                    'method' => $interview->interview_method,
                    'location' => $interview->interview_location,
                    'interviewer' => $interview->interviewer_name,
                ],
                'link' => route('panel.jadwal-interview.pelamar.show', $interview->uuid), // Gunakan route untuk pelamar
            ]);

            return redirect()->route('panel.jadwal-interview.index')
                ->with('success', 'Interview schedule created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create interview schedule');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $interview = InterviewSchedule::with(['application.applicant.profile', 'application.jobdesc'])
            ->where('uuid', $uuid)
            ->firstOrFail();

        return view('backend.jadwal-interview.show', [
            'interview' => $interview,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $interview = InterviewSchedule::with(['application.applicant.profile', 'application.jobdesc'])
            ->where('uuid', $uuid)
            ->firstOrFail();

        $applications = Lamaran::with(['applicant.profile', 'jobdesc'])
            ->where('status', 'accepted')
            ->get();

        return view('backend.jadwal-interview.edit', [
            'interview' => $interview,
            'applications' => $applications,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $validatedData = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'interview_date' => 'required|date',
            'interview_method' => 'required|in:online,offline',
            'interview_location' => 'nullable|string',
            'interviewer_name' => 'required|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,completed,cancelled',
        ]);

        try {
            $interview = InterviewSchedule::where('uuid', $uuid)->firstOrFail();
            $oldDate = $interview->interview_date;

            $interview->update($validatedData);
            $interview->load('application.applicant');

            // Buat notifikasi jika ada perubahan penting
            if ($oldDate != $validatedData['interview_date'] ||
                $interview->isDirty(['interview_method', 'interview_location', 'status'])) {

                Notification::create([
                    'user_id' => $interview->application->applicant->id,
                    'title' => 'Perubahan Jadwal Interview',
                    'message' => "Jadwal interview Anda telah diperbarui menjadi " .
                    Carbon::parse($interview->interview_date)->format('d F Y H:i'),
                    'type' => 'interview_update',
                    'data' => [
                        'interview_id' => $interview->id,
                        'date' => $interview->interview_date,
                        'method' => $interview->interview_method,
                        'location' => $interview->interview_location,
                        'interviewer' => $interview->interviewer_name,
                        'status' => $interview->status,
                    ],
                    'link' => route('panel.jadwal-interview.pelamar.show', $interview->uuid),
                ]);
            }

            return redirect()->route('panel.jadwal-interview.index')
                ->with('success', 'Interview schedule updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update interview schedule');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid): JsonResponse
    {
        $interview = InterviewSchedule::where('uuid', $uuid)->firstOrFail();
        $interview->delete();
        return response()->json(['message' => 'Interview schedule deleted successfully']);
    }

    public function downloadReport(Request $request)
    {
        try {
            $data = $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'format' => 'required|in:pdf,excel',
            ]);

            // Format nama file
            $start = Carbon::parse($data['start_date'])->format('d-m-Y');
            $end = Carbon::parse($data['end_date'])->format('d-m-Y');
            $filename = "laporan_interview_periode_{$start}_sd_{$end}";

            if ($data['format'] === 'pdf') {
                $report = new InterviewPDFReport($data['start_date'], $data['end_date']);
                $pdf = $report->generate();
                return $pdf->download($filename . '.pdf');
            } else {
                return Excel::download(
                    new InterviewExport($data['start_date'], $data['end_date']),
                    $filename . '.xlsx'
                );
            }
        } catch (\Exception $error) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $error->getMessage());
        }
    }
}
