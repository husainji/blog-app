<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class LogActivity
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        try {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => $request->method().' '.$request->path(),
                'meta' => json_encode(['params' => $request->all()]),
                'ip' => $request->ip(),
            ]);
        } catch (\Exception $e) {
            // avoid breaking app on logging error
        }

        return $response;
    }
}
