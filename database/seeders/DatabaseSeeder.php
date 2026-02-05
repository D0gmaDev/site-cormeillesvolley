<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\Player;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin de test
        User::create([
            'name' => 'Admin Account',
            'email' => 'admin@cormeillesvolley95.fr',
        ]);

        // Rôles Bureau
        $rolePresident = Role::create(['name' => 'Président', 'section' => 'Bureau', 'order' => 1]);
        $roleSecretaire = Role::create(['name' => 'Secrétaire', 'section' => 'Bureau', 'order' => 2]);
        $roleTresorier = Role::create(['name' => 'Trésorier', 'section' => 'Bureau', 'order' => 3]);

        // Quelques joueurs
        $players = [];
        $firstNames = ['Lucas', 'Emma', 'Hugo', 'Chloé', 'Louis', 'Léa', 'Gabriel', 'Manon', 'Arthur', 'Julie'];
        $lastNames = ['Martin', 'Bernard', 'Dubois', 'Thomas', 'Robert', 'Richard', 'Petit', 'Durand', 'Leroy', 'Moreau'];

        for ($i = 0; $i < 20; $i++) {
            $players[] = Player::create([
                'first_name' => $firstNames[$i % 10],
                'last_name' => $lastNames[$i % 10],
                'birth_date' => now()->subYears(rand(18, 35))->subDays(rand(0, 365)),
            ]);
        }

        // Équipes
        $sm1 = Team::create([
            'name' => 'Seniors Masculins 1',
            'slug' => 'SM-1',
            'genre' => 'M',
            'section' => 'Seniors',
            'niveau' => 'Régional 1',
        ]);

        $sf1 = Team::create([
            'name' => 'Seniors Féminines 1',
            'slug' => 'SF-1',
            'genre' => 'F',
            'section' => 'Seniors',
            'niveau' => 'Régional 2',
        ]);

        $m15 = Team::create([
            'name' => 'M15 Masculins',
            'slug' => 'M15M-1',
            'genre' => 'M',
            'section' => 'Jeunes',
            'niveau' => 'Départemental',
        ]);

        $loisirs = Team::create([
            'name' => 'Loisirs Mixte',
            'slug' => 'LOISIRS-1',
            'genre' => 'Mixte',
            'section' => 'Loisirs',
        ]);

        // Ajout des joueurs aux équipes SM1
        for ($i = 0; $i < 6; $i++) {
            $sm1->players()->attach($players[$i]->id, [
                'number' => $i + 1,
                'position' => ['Pointu', 'Central', 'Réceptionneur-Attaquant', 'Passeur', 'Libéro', 'Central'][$i],
            ]);
        }
        // Coach SM1
        $sm1->players()->attach($players[10]->id, ['position' => 'Coach']);

        // Ajout des joueurs aux équipes SF1
        for ($i = 6; $i < 11; $i++) {
            $sf1->players()->attach($players[$i]->id, [
                'number' => $i - 5,
                'position' => ['Pointue', 'Centrale', 'Réceptionneuse-Attaquante', 'Passeuse', 'Libéro'][$i - 6],
            ]);
        }
        // Coach SF1
        $sf1->players()->attach($players[12]->id, ['position' => 'Coach']);

        // Rôles Bureau
        $players[0]->roles()->attach($rolePresident);
        $players[1]->roles()->attach($roleSecretaire);
        $players[2]->roles()->attach($roleTresorier);

        // Partenaires
        Partner::create(['name' => 'Test 1', 'logo' => 'partners/1.png', 'url' => 'https://google.com', 'order' => 1]);
        Partner::create(['name' => 'Test 2', 'logo' => 'partners/2.png', 'url' => 'https://google.com', 'order' => 2]);
        Partner::create(['name' => 'Test 3', 'logo' => 'partners/3.png', 'url' => 'https://google.com', 'order' => 3]);
    }
}
