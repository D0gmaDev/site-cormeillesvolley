<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PartnerController extends Controller
{
    public function index(): Response
    {
        $partners = Partner::orderBy('order')->get();

        return Inertia::render('admin/partners/Index', [
            'partners' => $partners->map(fn ($p) => [
                'id' => $p->id,
                'name' => $p->name,
                'logo_url' => $p->logo_url,
                'url' => $p->url,
                'order' => $p->order,
            ]),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/partners/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
            'order' => 'nullable|integer',
            'logo' => 'required|image|max:2048',
        ]);

        $validated['logo'] = $request->file('logo')->store('partners', 'public');
        $validated['order'] = $validated['order'] ?? Partner::max('order') + 1;

        Partner::create($validated);

        return redirect()->route('admin.partenaires.index')
            ->with('success', 'Partenaire créé avec succès.');
    }

    public function edit(Partner $partenaire): Response
    {
        return Inertia::render('admin/partners/Edit', [
            'partner' => [
                'id' => $partenaire->id,
                'name' => $partenaire->name,
                'logo' => $partenaire->logo,
                'logo_url' => $partenaire->logo_url,
                'url' => $partenaire->url,
                'order' => $partenaire->order,
            ],
        ]);
    }

    public function update(Request $request, Partner $partenaire): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $partenaire->update($validated);

        return redirect()->route('admin.partenaires.index')
            ->with('success', 'Partenaire mis à jour avec succès.');
    }

    public function destroy(Partner $partenaire): RedirectResponse
    {
        $partenaire->delete();

        return redirect()->route('admin.partenaires.index')
            ->with('success', 'Partenaire supprimé avec succès.');
    }
}
