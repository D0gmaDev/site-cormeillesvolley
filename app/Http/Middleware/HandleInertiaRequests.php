<?php

namespace App\Http\Middleware;

use App\Models\Partner;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'auth' => [
                'user' => $request->user(),
            ],
            'partners' => fn () => Partner::orderBy('order')->get()->map(fn ($p) => [
                'id' => $p->id,
                'name' => $p->name,
                'logo_url' => $p->logo ? asset('storage/'.$p->logo) : asset('images/placeholder-partner.svg'),
                'url' => $p->url,
            ]),
        ];
    }
}
