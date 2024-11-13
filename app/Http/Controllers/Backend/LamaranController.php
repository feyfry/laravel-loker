<?php

namespace App\Http\Controllers\Backend;

use App\Exports\LamaranExport;
use App\Http\Controllers\Controller;
use App\Mail\LamaranConfirmMail;
use App\Models\Lamaran;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class LamaranController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$request->user()->hasRole('admin')) {
                abort(403, 'Unauthorized action.');
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $lamarans = Lamaran::with(['jobdesc', 'applicant.profile'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('backend.lamaran.index', [
            'lamarans' => $lamarans,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid): View
    {
        // Alternatif bisa menggunakan fungsi whereUuid($uuid)->firstOrFail();
        $lamaran = Lamaran::with(['jobdesc', 'applicant.profile'])->where('uuid', $uuid)->firstOrFail();

        return view('backend.lamaran.show', [
            'lamaran' => $lamaran,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid): View
    {
        $lamaran = Lamaran::where('uuid', $uuid)->firstOrFail();
        return view('backend.lamaran.edit', [
            'lamaran' => $lamaran,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid): RedirectResponse
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,reviewed,accepted,rejected',
        ]);

        try {
            $lamaran = Lamaran::where('uuid', $uuid)
                ->with(['applicant']) // Eager load the applicant relationship
                ->firstOrFail();

            $lamaran->status = $validatedData['status'];
            $lamaran->save();

            // Get email from applicant relationship
            $userEmail = $lamaran->applicant->email;

            // Send email
            Mail::to($userEmail)
                ->cc('feifeifry@gmail.com')
                ->send(new LamaranConfirmMail($lamaran));

            return redirect()->back()->with('success', 'Lamaran status updated successfully');
        } catch (\Exception $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid): JsonResponse
    {
        $lamaran = Lamaran::where('uuid', $uuid)->firstOrFail();
        $lamaran->delete();
        return response()->json([
            'message' => 'Lamaran deleted successfully',
        ]);
    }

    public function download(Request $request)
    {
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        try {
            return Excel::download(new LamaranExport($data['start_date'], $data['end_date']), 'laporan_lamaran.xlsx');
        } catch (\Exception $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }
    }
}
