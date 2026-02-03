<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BureauController extends Controller
{
    public function index(): Response
    {
        $roles = Role::where('section', 'Bureau')
            ->orderBy('order')
            ->with('players')
            ->get();

        return Inertia::render('admin/bureau/Index', [
            'roles' => $roles->map(fn ($role) => [
                'id' => $role->id,
                'name' => $role->name,
                'order' => $role->order,
                'players' => $role->players->map(fn ($p) => [
                    'id' => $p->id,
                    'full_name' => $p->full_name,
                    'photo_url' => $p->photo_url,
                ]),
            ]),
        ]);
    }

    public function create(): Response
    {
        $players = Player::orderBy('last_name')->orderBy('first_name')->get();

        return Inertia::render('admin/bureau/Create', [
            'players' => $players->map(fn ($p) => [
                'id' => $p->id,
                'full_name' => $p->full_name,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer|min:1',
            'player_id' => 'required|exists:players,id',
        ]);

        $role = Role::create([
            'name' => $validated['name'],
            'section' => 'Bureau',
            'order' => $validated['order'],
        ]);

        $role->players()->attach($validated['player_id']);

        return redirect()->route('admin.bureau.index')->with('success', 'Rôle ajouté avec succès');
    }

    public function edit(Role $bureau): Response
    {
        $players = Player::orderBy('last_name')->orderBy('first_name')->get();

        return Inertia::render('admin/bureau/Edit', [
            'role' => [
                'id' => $bureau->id,
                'name' => $bureau->name,
                'order' => $bureau->order,
                'player_id' => $bureau->players->first()?->id,
            ],
            'players' => $players->map(fn ($p) => [
                'id' => $p->id,
                'full_name' => $p->full_name,
            ]),
        ]);
    }

    public function update(Request $request, Role $bureau): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer|min:1',
            'player_id' => 'required|exists:players,id',
        ]);

        $bureau->update([
            'name' => $validated['name'],
            'order' => $validated['order'],
        ]);

        $bureau->players()->sync([$validated['player_id']]);

        return redirect()->route('admin.bureau.index')->with('success', 'Rôle modifié avec succès');
    }

    public function destroy(Role $bureau): RedirectResponse
    {
        $bureau->players()->detach();
        $bureau->delete();

        return redirect()->route('admin.bureau.index')->with('success', 'Rôle supprimé avec succès');
    }
}
