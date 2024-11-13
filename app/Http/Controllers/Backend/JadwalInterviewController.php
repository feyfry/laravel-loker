<?php

namespace App\Http\Controllers\Backend;

use App\Models\Lamaran;
use Illuminate\Http\Request;
use App\Models\InterviewSchedule;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            InterviewSchedule::create($validatedData);

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
            $interview->update($validatedData);
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
}
