<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { Plus, Pencil, Trash2, Search } from 'lucide-vue-next';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import AdminLayout from '@/layouts/AdminLayout.vue';

interface Player {
    id: number;
    first_name: string;
    last_name: string;
    photo_url: string;
    teams_count: number;
}

interface Props {
    players: {
        data: Player[];
        links: any[];
        meta: any;
    };
    filters: { search?: string };
}

const props = defineProps<Props>();

const search = ref(props.filters.search || '');

const searchPlayers = () => {
    router.get('/admin/joueurs', { search: search.value }, { preserveState: true });
};

const deletePlayer = (player: Player) => {
    if (confirm(`Supprimer "${player.first_name} ${player.last_name}" ?`)) {
        router.delete(`/admin/joueurs/${player.id}`);
    }
};
</script>

<template>
    <AdminLayout title="Joueurs">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold uppercase tracking-tight text-raisin">Joueurs</h1>
                <Link href="/admin/joueurs/create">
                    <Button class="gap-2 bg-cardinal hover:bg-cardinal-dark">
                        <Plus class="h-4 w-4" />
                        Nouveau joueur
                    </Button>
                </Link>
            </div>

            <div class="flex gap-4">
                <div class="relative flex-1">
                    <Search class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" />
                    <Input
                        v-model="search"
                        placeholder="Rechercher un joueur..."
                        class="pl-10"
                        @keyup.enter="searchPlayers"
                    />
                </div>
                <Button variant="outline" @click="searchPlayers">Rechercher</Button>
            </div>

            <div class="overflow-hidden rounded-lg bg-white shadow">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Joueur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Équipes</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="player in players.data" :key="player.id" class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img :src="player.photo_url" class="h-10 w-10 rounded-full object-cover" />
                                    <span class="font-medium text-raisin">{{ player.first_name }} {{ player.last_name }}</span>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-600">{{ player.teams_count }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <Link :href="`/admin/joueurs/${player.id}/edit`">
                                        <Button size="sm" variant="outline" class="gap-1">
                                            <Pencil class="h-3 w-3" />
                                            Éditer
                                        </Button>
                                    </Link>
                                    <Button
                                        size="sm"
                                        variant="outline"
                                        class="gap-1 text-red-600 hover:bg-red-50"
                                        :disabled="player.teams_count > 0"
                                        @click="deletePlayer(player)"
                                    >
                                        <Trash2 class="h-3 w-3" />
                                    </Button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="players.data.length === 0">
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                Aucun joueur trouvé.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
