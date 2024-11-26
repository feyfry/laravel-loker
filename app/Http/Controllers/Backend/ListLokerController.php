<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\LamaranPendingMail;
use App\Models\Lamaran;
use App\Models\ListLoker;
use App\Models\Notification;
use App\Models\Profile;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ListLokerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $per_page = $request->query('per_page', 10);

        $lokers = ListLoker::where('status', 'open')
            ->select('uuid', 'title', 'company_name', 'location', 'position', 'salary_range_min', 'salary_range_max', 'created_at')
            ->latest()
            ->paginate($per_page);

        return view('backend.list.index', [
            'lokers' => $lokers,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid): View
    {
        $loker = ListLoker::where('uuid', $uuid)->firstOrFail();
        $postedByUser = Profile::where('user_id', $loker->posted_by)->first();

        // Check if user has completed profile
        $hasCompleteProfile = Profile::where('user_id', Auth::id())->exists();

        // Check if user has already applied
        $hasApplied = Lamaran::where('jobdesc_id', $loker->id)
            ->where('applicant_id', Auth::id())
            ->exists();

        return view('backend.list.show', [
            'loker' => $loker,
            'users' => $postedByUser,
            'hasCompleteProfile' => $hasCompleteProfile,
            'hasApplied' => $hasApplied,
        ]);
    }

    public function apply(Request $request, string $uuid): JsonResponse
    {
        $loker = ListLoker::where('uuid', $uuid)
            ->with(['user']) // Eager load the user relationship
            ->firstOrFail();

        try {
            // Get currently logged in user
            $currentUser = Auth::user();

            // Check if profile exists
            $hasProfile = Profile::where('user_id', Auth::id())->first();
            if (!$hasProfile) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Silahkan lengkapi profil Anda terlebih dahulu',
                    'redirect' => route('panel.profile.edit'),
                ], 422);
            }

            // Check if already applied
            $existingApplication = Lamaran::where('jobdesc_id', $loker->id)
                ->where('applicant_id', Auth::id())
                ->first();

            if ($existingApplication) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda sudah melamar pekerjaan ini',
                ], 422);
            }

            // Create application
            $lamaran = Lamaran::create([
                'uuid' => (string) Str::uuid(),
                'jobdesc_id' => $loker->id,
                'applicant_id' => Auth::id(),
                'status' => 'pending',
                'date' => now('Asia/Jakarta')->format('Y-m-d'),
            ]);

            // Send email
            Mail::to($currentUser->email)
                ->cc('feifeifry@gmail.com')
                ->send(new LamaranPendingMail($lamaran));

            Notification::create([
                'user_id' => $loker->posted_by,
                'title' => 'Lamaran Baru',
                'message' => "{$lamaran->applicant->profile->full_name} telah melamar untuk posisi {$loker->title}",
                'type' => 'lamaran',
                'data' => [
                    'lamaran_id' => $lamaran->id,
                    'loker_id' => $loker->id,
                ],
                'link' => route('panel.lamaran.show', $lamaran->uuid),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Lamaran berhasil dikirim',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
