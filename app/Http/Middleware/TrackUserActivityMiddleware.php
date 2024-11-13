<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpFoundation\Response;

class TrackUserActivityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $agent = new Agent();

        $userData = [
            'user_id' => Auth::check() ? Auth::id() : null,
            'session_id' => Session::getId(),
            'ip_address' => $request->ip(),
            'location' => Location::get($request->ip()) ?? [],
            'browser' => [
                'browser' => $agent->browser(),
                'browser_version' => $agent->version($agent->browser()),
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'platform_version' => $agent->version($agent->platform()),
                'is_mobile' => $agent->isMobile(),
                'is_tablet' => $agent->isTablet(),
                'is_desktop' => $agent->isDesktop(),
            ],
            'user_agent' => $request->userAgent(),
            'last_activity' => Carbon::now(),
            'last_page' => $request->fullUrl(),
            'referrer' => $request->headers->get('referer'),
        ];

        // Simpan ke database
        UserActivity::create($userData);

        return $next($request);

    }
}
