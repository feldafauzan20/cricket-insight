<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */

    protected array $available;

    public function __construct()
    {
        $this->available = config('app.available_locales');
    }

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);

        if (!in_array($locale, $this->available)) {
            abort(404);
        }

        App::setLocale(in_array($locale, $this->available) ? $locale : config('app.locale'));

        return $next($request);
    }
}
