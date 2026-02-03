<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { Plus, Pencil, Trash2 } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import AdminLayout from '@/layouts/AdminLayout.vue';

interface Team {
    id: number;
    name: string;
    slug: string;
    genre: string;
    section: string;
    niveau: string | null;
    players_count: number;
}

interface Props {
    teams: Team[];
}

defineProps<Props>();

const deleteTeam = (team: Team) => {
    if (confirm(`Supprimer l'équipe "${team.name}" ?`)) {
        router.delete(`/admin/equipes/${team.id}`);
    }
};
</script>

<template>
    <AdminLayout title="Équipes">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold uppercase tracking-tight text-raisin">Équipes</h1>
                <Link href="/admin/equipes/create">
                    <Button class="gap-2 bg-cardinal hover:bg-cardinal-dark">
                        <Plus class="h-4 w-4" />
                        Nouvelle équipe
                    </Button>
                </Link>
            </div>

            <div class="overflow-hidden rounded-lg bg-white shadow">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Section</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Genre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Niveau</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Joueurs</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="team in teams" :key="team.id" class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 font-medium text-raisin">{{ team.name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-600">{{ team.section }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span
                                    class="inline-block rounded px-2 py-0.5 text-xs font-semibold"
                                    :class="{
                                        'bg-blue-100 text-blue-800': team.genre === 'M',
                                        'bg-pink-100 text-pink-800': team.genre === 'F',
                                        'bg-purple-100 text-purple-800': team.genre === 'Mixte',
                                    }"
                                >
                                    {{ team.genre }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-600">{{ team.niveau || '-' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-600">{{ team.players_count }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <Link :href="`/admin/equipes/${team.id}/edit`">
                                        <Button size="sm" variant="outline" class="gap-1">
                                            <Pencil class="h-3 w-3" />
                                            Éditer
                                        </Button>
                                    </Link>
                                    <Button size="sm" variant="outline" class="gap-1 text-red-600 hover:bg-red-50" @click="deleteTeam(team)">
                                        <Trash2 class="h-3 w-3" />
                                    </Button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="teams.length === 0">
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                Aucune équipe pour le moment.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
