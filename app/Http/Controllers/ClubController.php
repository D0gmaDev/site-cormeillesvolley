<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Team;
use Inertia\Inertia;

class ClubController extends Controller
{
    public function bureau()
    {
        $roles = Role::where('section', 'Bureau')
            ->orderBy('order')
            ->with(['players:id,first_name,last_name,photo'])
            ->get();

        $members = [];
        foreach ($roles as $role) {
            foreach ($role->players as $player) {
                $members[] = [
                    'id' => $player->id,
                    'name' => $player->full_name,
                    'role' => $role->name,
                    'photo_url' => $player->photo_url,
                    'order' => $role->order,
                ];
            }
        }

        usort($members, fn ($a, $b) => $a['order'] <=> $b['order']);

        return Inertia::render('club/Bureau', [
            'members' => $members,
        ]);
    }

    public function encadrement()
    {
        $teams = Team::with(['coachs' => fn ($q) => $q->select('players.id', 'first_name', 'last_name', 'photo')])
            ->orderBy('section')
            ->orderBy('name')
            ->get();

        $coaches = [];
        $seen = [];

        foreach ($teams as $team) {
            foreach ($team->coachs as $coach) {
                $key = $coach->id;
                if (! isset($seen[$key])) {
                    $seen[$key] = [
                        'id' => $coach->id,
                        'name' => $coach->full_name,
                        'teams' => [],
                        'photo_url' => $coach->photo_url,
                    ];
                }
                $seen[$key]['teams'][] = $team->name;
            }
        }

        foreach ($seen as $data) {
            $coaches[] = [
                'id' => $data['id'],
                'name' => $data['name'],
                'role' => 'Coach '.implode(', ', $data['teams']),
                'photo_url' => $data['photo_url'],
            ];
        }

        return Inertia::render('club/Encadrement', [
            'coaches' => $coaches,
        ]);
    }
}
