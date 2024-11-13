<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\InterviewSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelamarInterviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $interviews = InterviewSchedule::whereHas('application', function ($query) {
            $query->where('applicant_id', Auth::id());
        })->with(['application.jobdesc'])
            ->orderBy('interview_date', 'desc')
            ->paginate(10);

        return view('backend.jadwal-interview.pelamar.index', [
            'interviews' => $interviews,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $interview = InterviewSchedule::whereHas('application', function ($query) {
            $query->where('applicant_id', Auth::id());
        })->with(['application.applicant.profile', 'application.jobdesc'])
            ->where('uuid', $uuid)
            ->firstOrFail();

        return view('backend.jadwal-interview.pelamar.show', [
            'interview' => $interview,
        ]);

    }
}
