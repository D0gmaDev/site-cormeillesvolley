<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PlayerController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Player::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $players = $query->withCount('teams')->orderBy('last_name')->paginate(20);

        return Inertia::render('admin/players/Index', [
            'players' => [
                'data' => $players->map(fn ($p) => [
                    'id' => $p->id,
                    'first_name' => $p->first_name,
                    'last_name' => $p->last_name,
                    'photo_url' => $p->photo_url,
                    'teams_count' => $p->teams_count,
                ]),
                'links' => $players->linkCollection(),
                'meta' => [
                    'current_page' => $players->currentPage(),
                    'last_page' => $players->lastPage(),
                    'total' => $players->total(),
                ],
            ],
            'filters' => $request->only('search'),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/players/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'birth_date' => 'nullable|date',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('players', 'public');
        }

        Player::create($validated);

        return redirect()->route('admin.joueurs.index')
            ->with('success', 'Joueur créé avec succès.');
    }

    public function edit(Player $joueur): Response
    {
        return Inertia::render('admin/players/Edit', [
            'player' => [
                'id' => $joueur->id,
                'first_name' => $joueur->first_name,
                'last_name' => $joueur->last_name,
                'birth_date' => $joueur->birth_date?->format('Y-m-d'),
                'photo' => $joueur->photo,
                'photo_url' => $joueur->photo_url,
                'teams' => $joueur->teams->map(fn ($t) => [
                    'id' => $t->id,
                    'name' => $t->name,
                    'position' => $t->pivot->position,
                ]),
            ],
        ]);
    }

    public function update(Request $request, Player $joueur): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'birth_date' => 'nullable|date',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('players', 'public');
        }

        $joueur->update($validated);

        return redirect()->route('admin.joueurs.index')
            ->with('success', 'Joueur mis à jour avec succès.');
    }

    public function destroy(Player $joueur): RedirectResponse
    {
        if ($joueur->teams()->count() > 0) {
            return redirect()->route('admin.joueurs.index')
                ->with('error', 'Impossible de supprimer un joueur qui appartient à une équipe.');
        }

        $joueur->delete();

        return redirect()->route('admin.joueurs.index')
            ->with('success', 'Joueur supprimé avec succès.');
    }
}
