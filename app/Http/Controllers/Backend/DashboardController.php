<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            // Statistik aplikasi
            $totalApplications = Lamaran::count();
            $pendingApplications = Lamaran::where('status', 'pending')->count();
            $reviewedApplications = Lamaran::where('status', 'reviewed')->count();
            $acceptedApplications = Lamaran::where('status', 'accepted')->count();
            $rejectedApplications = Lamaran::where('status', 'rejected')->count();

            // 5 aplikasi terbaru
            $latestApplications = Lamaran::with(['jobdesc', 'applicant'])
                ->latest()
                ->take(5)
                ->get();

            // Data untuk grafik line (aplikasi per hari selama 7 hari terakhir)
            $applicationsPerDay = Lamaran::where('date', '>=', Carbon::now()->subDays(7))
                ->groupBy('date')
                ->selectRaw('date, count(*) as count')
                ->get();

            // Data untuk grafik doughnut (distribusi status aplikasi)
            $applicationStatusDistribution = [
                'pending' => $pendingApplications,
                'reviewed' => $reviewedApplications,
                'accepted' => $acceptedApplications,
                'rejected' => $rejectedApplications,
            ];

            return view('backend.dashboard.index', [
                'totalApplications' => $totalApplications,
                'pendingApplications' => $pendingApplications,
                'reviewedApplications' => $reviewedApplications,
                'acceptedApplications' => $acceptedApplications,
                'rejectedApplications' => $rejectedApplications,
                'latestApplications' => $latestApplications,
                'applicationsPerDay' => $applicationsPerDay,
                'applicationStatusDistribution ' => $applicationStatusDistribution,
            ]);
        } else {
            // Cache key unik berdasarkan IP dan session | user info
            $cacheKey = 'user_info_' . $request->ip() . '_' . Session::getId();

            // Cache key untuk status lamaran
            $lamaranCacheKey = 'user_lamaran_' . Auth::id();

            // Mencoba mengambil data dari cache
            $userInfo = Cache::remember($cacheKey, 60, function () use ($request) {
                $agent = new Agent();
                $ip = $request->ip();

                // Cache location data
                $position = Cache::remember('ip_location_' . $ip, 360, function () use ($ip) {
                    return Location::get($ip);
                });

                return [
                    'ip_address' => $ip,
                    'country' => $position ? $position->countryName : 'Unknown',
                    'city' => $position ? $position->cityName : 'Unknown',
                    'browser' => $agent->browser() . ' ' . $agent->version($agent->browser()),
                    'platform' => $agent->platform() . ' ' . $agent->version($agent->platform()),
                    'device_type' => $agent->isMobile() ? 'Mobile' : ($agent->isTablet() ? 'Tablet' : 'Desktop'),
                    'user_agent' => $request->userAgent(),
                    'referrer' => $request->server('HTTP_REFERER'),
                ];
            });

            // Update waktu secara real-time
            $userInfo['last_activity'] = Carbon::now()->timezone('Asia/Jakarta');
            $userInfo['last_page'] = url()->previous();

            // Mengambil semua lamaran dari user yang sedang login
            // Cache untuk lamaran - cache time (30 detik) agar status lebih real-time
            $lamaran = Cache::remember($lamaranCacheKey, 30, function () {
                return Lamaran::with(['jobdesc'])
                    ->where('applicant_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();
            });

            return view('backend.dashboard.index', [
                'userInfo' => $userInfo,
                'lamaran' => $lamaran,
            ]);
        }
    }
}
