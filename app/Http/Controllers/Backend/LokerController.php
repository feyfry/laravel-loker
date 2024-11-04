<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Loker;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LokerController extends Controller
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
    public function index(Request $request): View
    {
        $per_page = $request->query('per_page', 10);

        $lokers = Loker::select('uuid', 'title', 'company_name', 'position', 'type', 'status')
            ->latest()
            ->paginate($per_page);

        return view('backend.loker.index', [
            'lokers' => $lokers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Ambil profile dengan id asli dari table applicant_profiles
        $users = Profile::select('id', 'full_name')
            ->where('user_id', Auth::user()->id)
            ->get();

        return view('backend.loker.create', [
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            // Validasi terhadap id di table applicant_profiles
            'posted_by' => 'required|exists:applicant_profiles,id',
            'title' => 'required|string|min:2|max:100',
            'company_name' => 'required|string',
            'location' => 'required|string',
            'position' => 'required|string',
            'type' => 'required|string',
            'salary_range_min' => 'nullable|numeric',
            'salary_range_max' => 'nullable|numeric',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'questions' => 'required|string',
            'status' => 'required|string|in:open,closed',
        ]);

        try {
            Loker::create($validatedData);
            return redirect()->route('panel.loker.index')->with('success', 'Loker created successfully');
        } catch (\Exception $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid): View
    {
        $loker = Loker::where('uuid', $uuid)->firstOrFail();
        $postedByUser = Profile::where('id', $loker->posted_by)->firstOrFail();

        return view('backend.loker.show', [
            'loker' => $loker,
            'users' => $postedByUser,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid): View
    {
        $loker = Loker::where('uuid', $uuid)->firstOrFail();

        // Ambil profile dengan id asli dari table applicant_profiles
        $users = Profile::select('id', 'full_name')
            ->where('user_id', Auth::user()->id)
            ->get();

        return view('backend.loker.edit', [
            'loker' => $loker,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid): RedirectResponse
    {
        $validatedData = $request->validate([
            // Validasi terhadap id di table applicant_profiles
            'posted_by' => 'required|exists:applicant_profiles,id',
            'title' => 'required|string|min:2|max:100',
            'company_name' => 'required|string',
            'location' => 'required|string',
            'position' => 'required|string',
            'type' => 'required|string',
            'salary_range_min' => 'nullable|numeric',
            'salary_range_max' => 'nullable|numeric',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'questions' => 'required|string',
            'status' => 'required|string|in:open,closed',
        ]);

        try {
            $loker = Loker::where('uuid', $uuid)->firstOrFail();
            $loker->update($validatedData);
            return redirect()->route('panel.loker.index')->with('success', 'Loker updated successfully');
        } catch (\Exception $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid): JsonResponse
    {
        $loker = Loker::where('uuid', $uuid)->firstOrFail();
        $loker->delete();
        return response()->json([
            'message' => 'Loker deleted successfully',
        ]);
    }
}
