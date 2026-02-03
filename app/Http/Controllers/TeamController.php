<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TeamController extends Controller
{
    private const SECTION_MAP = [
        'seniors' => 'Seniors',
        'jeunes' => 'Jeunes',
        'ecole-de-volley' => 'Ecole de Volley',
        'loisirs' => 'Loisirs',
        'fsgt' => 'FSGT',
    ];

    public function section(string $section): Response|RedirectResponse
    {
        $sectionName = self::SECTION_MAP[$section] ?? abort(404);

        $teams = Team::where('section', $sectionName)->get();

        if ($teams->count() === 1) {
            return redirect()->route('equipes.show', $teams->first()->slug);
        }

        return Inertia::render('equipes/Section', [
            'section' => $sectionName,
            'teams' => $teams,
        ]);
    }

    private const POSITION_MAP = [
        'Pointu' => 'Pointue',
        'Central' => 'Centrale',
        'Réceptionneur-Attaquant' => 'Réceptionneuse-Attaquante',
        'Passeur' => 'Passeuse',
        'Complet' => 'Complète',
    ];

    private function feminizePosition(?string $position, string $genre): ?string
    {
        if ($position === null || $genre !== 'F') {
            return $position;
        }

        return self::POSITION_MAP[$position] ?? $position;
    }

    public function show(string $slug): Response
    {
        $team = Team::where('slug', $slug)
            ->with(['coachs', 'joueurs'])
            ->firstOrFail();

        return Inertia::render('equipes/Show', [
            'team' => [
                'id' => $team->id,
                'name' => $team->name,
                'slug' => $team->slug,
                'genre' => $team->genre,
                'section' => $team->section,
                'niveau' => $team->niveau,
                'photo_url' => $team->photo_url,
                'ffvolley_embed_url' => $team->ffvolley_embed_url,
                'coachs' => $team->coachs->map(fn ($p) => [
                    'id' => $p->id,
                    'full_name' => $p->full_name,
                    'photo_url' => $p->photo_url,
                ]),
                'joueurs' => $team->joueurs->map(fn ($p) => [
                    'id' => $p->id,
                    'full_name' => $p->full_name,
                    'photo_url' => $p->photo_url,
                    'number' => $p->pivot->number,
                    'position' => $this->feminizePosition($p->pivot->position, $team->genre),
                ]),
            ],
        ]);
    }
}
