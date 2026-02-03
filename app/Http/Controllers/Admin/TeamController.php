<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TeamController extends Controller
{
    public function index(): Response
    {
        $teams = Team::withCount('players')->orderBy('section')->orderBy('name')->get();

        return Inertia::render('admin/teams/Index', [
            'teams' => $teams,
        ]);
    }

    public function create(): Response
    {
        $players = Player::orderBy('last_name')->get(['id', 'first_name', 'last_name']);

        return Inertia::render('admin/teams/Create', [
            'players' => $players->map(fn ($p) => [
                'id' => $p->id,
                'name' => $p->full_name,
            ]),
            'sections' => ['Seniors', 'Jeunes', 'Ecole de Volley', 'Loisirs', 'FSGT'],
            'genres' => ['M', 'F', 'Mixte'],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:50|unique:teams',
            'genre' => 'required|in:M,F,Mixte',
            'section' => 'required|in:Seniors,Jeunes,Ecole de Volley,Loisirs,FSGT',
            'niveau' => 'nullable|string|max:100',
            'ffvolley_embed_url' => 'nullable|url',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('teams', 'public');
        }

        Team::create($validated);

        return redirect()->route('admin.equipes.index')
            ->with('success', 'Équipe créée avec succès.');
    }

    public function edit(Team $equipe): Response
    {
        $equipe->load(['players']);
        $players = Player::orderBy('last_name')->get(['id', 'first_name', 'last_name']);

        return Inertia::render('admin/teams/Edit', [
            'team' => [
                'id' => $equipe->id,
                'name' => $equipe->name,
                'slug' => $equipe->slug,
                'genre' => $equipe->genre,
                'section' => $equipe->section,
                'niveau' => $equipe->niveau,
                'photo' => $equipe->photo,
                'photo_url' => $equipe->photo_url,
                'ffvolley_embed_url' => $equipe->ffvolley_embed_url,
                'players' => $equipe->players->map(fn ($p) => [
                    'id' => $p->id,
                    'name' => $p->full_name,
                    'number' => $p->pivot->number,
                    'position' => $p->pivot->position,
                ]),
            ],
            'allPlayers' => $players->map(fn ($p) => [
                'id' => $p->id,
                'name' => $p->full_name,
            ]),
            'sections' => ['Seniors', 'Jeunes', 'Ecole de Volley', 'Loisirs', 'FSGT'],
            'genres' => ['M', 'F', 'Mixte'],
        ]);
    }

    public function update(Request $request, Team $equipe): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:50|unique:teams,slug,'.$equipe->id,
            'genre' => 'required|in:M,F,Mixte',
            'section' => 'required|in:Seniors,Jeunes,Ecole de Volley,Loisirs,FSGT',
            'niveau' => 'nullable|string|max:100',
            'ffvolley_embed_url' => 'nullable|url',
            'players' => 'nullable|array',
            'players.*.id' => 'required|exists:players,id',
            'players.*.number' => 'nullable|integer',
            'players.*.position' => 'required|string',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('teams', 'public');
        }

        $equipe->update($validated);

        if (isset($validated['players'])) {
            $syncData = [];
            foreach ($validated['players'] as $player) {
                $syncData[$player['id']] = [
                    'number' => $player['number'],
                    'position' => $player['position'],
                ];
            }
            $equipe->players()->sync($syncData);
        }

        return redirect()->route('admin.equipes.index')
            ->with('success', 'Équipe mise à jour avec succès.');
    }

    public function destroy(Team $equipe): RedirectResponse
    {
        $equipe->delete();

        return redirect()->route('admin.equipes.index')
            ->with('success', 'Équipe supprimée avec succès.');
    }
}
