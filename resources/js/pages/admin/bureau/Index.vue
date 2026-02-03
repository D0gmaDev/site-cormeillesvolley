<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { Pencil, Plus, Trash2 } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import AdminLayout from '@/layouts/AdminLayout.vue';

interface Player {
    id: number;
    full_name: string;
    photo_url: string;
}

interface Role {
    id: number;
    name: string;
    order: number;
    players: Player[];
}

defineProps<{
    roles: Role[];
}>();

const deleteRole = (role: Role) => {
    if (confirm(`Supprimer le rôle "${role.name}" ?`)) {
        router.delete(`/admin/bureau/${role.id}`);
    }
};
</script>

<template>
    <AdminLayout title="Bureau">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold uppercase tracking-tight text-raisin">Bureau</h1>
                <Link href="/admin/bureau/create">
                    <Button class="gap-2 bg-cardinal hover:bg-cardinal-dark">
                        <Plus class="h-4 w-4" />
                        Nouveau rôle
                    </Button>
                </Link>
            </div>

            <div class="overflow-hidden rounded-lg bg-white shadow">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Ordre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Rôle</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Personne</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="role in roles" :key="role.id" class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 text-gray-600">{{ role.order }}</td>
                            <td class="whitespace-nowrap px-6 py-4 font-medium text-raisin">{{ role.name }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div v-if="role.players.length" class="flex items-center gap-3">
                                    <img
                                        :src="role.players[0].photo_url"
                                        class="h-10 w-10 rounded-full object-cover"
                                    />
                                    <span class="text-gray-600">{{ role.players[0].full_name }}</span>
                                </div>
                                <span v-else class="text-sm italic text-gray-400">Non assigné</span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <Link :href="`/admin/bureau/${role.id}/edit`">
                                        <Button size="sm" variant="outline" class="gap-1">
                                            <Pencil class="h-3 w-3" />
                                            Éditer
                                        </Button>
                                    </Link>
                                    <Button
                                        size="sm"
                                        variant="outline"
                                        class="gap-1 text-red-600 hover:bg-red-50"
                                        @click="deleteRole(role)"
                                    >
                                        <Trash2 class="h-3 w-3" />
                                    </Button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="roles.length === 0">
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                Aucun rôle de bureau pour le moment.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
