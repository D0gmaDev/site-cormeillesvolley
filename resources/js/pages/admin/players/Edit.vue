<script setup lang="ts">
import { useForm, Link, router } from '@inertiajs/vue3';
import { ArrowLeft, Upload, Trash2 } from 'lucide-vue-next';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AdminLayout from '@/layouts/AdminLayout.vue';

interface Team {
    id: number;
    name: string;
    position: string;
}

interface Player {
    id: number;
    first_name: string;
    last_name: string;
    birth_date: string | null;
    photo: string | null;
    photo_url: string;
    teams: Team[];
}

interface Props {
    player: Player;
}

const props = defineProps<Props>();

const form = useForm({
    first_name: props.player.first_name,
    last_name: props.player.last_name,
    birth_date: props.player.birth_date || '',
    photo: null as File | null,
});

const submit = () => {
    form.put(`/admin/joueurs/${props.player.id}`);
};

const handlePhotoChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files?.[0]) {
        form.photo = target.files[0];
    }
};

const photoInput = ref<HTMLInputElement | null>(null);

const deletePhoto = () => {
    if (confirm('Supprimer la photo du joueur ?')) {
        router.delete(`/admin/joueurs/${props.player.id}/photo`, {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <AdminLayout :title="`Éditer ${player.first_name} ${player.last_name}`">
        <div class="space-y-6">
            <div class="flex items-center gap-4">
                <Link href="/admin/joueurs">
                    <Button variant="ghost" size="sm" class="gap-2">
                        <ArrowLeft class="h-4 w-4" />
                        Retour
                    </Button>
                </Link>
                <h1 class="text-3xl font-bold uppercase tracking-tight text-raisin">
                    Éditer {{ player.first_name }} {{ player.last_name }}
                </h1>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <form @submit.prevent="submit" class="rounded-lg bg-white p-6 shadow">
                    <h2 class="mb-4 text-lg font-semibold text-raisin">Informations</h2>
                    <div class="space-y-4">
                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <Label for="first_name">Prénom</Label>
                                <Input id="first_name" v-model="form.first_name" required class="mt-1" />
                            </div>
                            <div>
                                <Label for="last_name">Nom</Label>
                                <Input id="last_name" v-model="form.last_name" required class="mt-1" />
                            </div>
                        </div>

                        <div>
                            <Label for="birth_date">Date de naissance</Label>
                            <Input id="birth_date" v-model="form.birth_date" type="date" class="mt-1" />
                        </div>

                        <div>
                            <Label for="photo">Photo</Label>
                            <div v-if="player.photo" class="mb-3 flex items-start gap-4">
                                <img :src="player.photo_url" alt="Photo actuelle" class="h-24 w-24 rounded-full object-cover" />
                                <Button type="button" variant="outline" size="sm" class="gap-1.5 text-red-600 hover:bg-red-50 hover:text-red-700" @click="deletePhoto">
                                    <Trash2 class="h-4 w-4" />
                                    Supprimer
                                </Button>
                            </div>
                            <input ref="photoInput" id="photo" type="file" accept="image/*" class="hidden" @change="handlePhotoChange" />
                            <button
                                type="button"
                                class="inline-flex items-center gap-2 rounded-lg border-2 border-dashed border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-600 transition-colors hover:border-cardinal hover:text-cardinal"
                                @click="photoInput?.click()"
                            >
                                <Upload class="h-4 w-4" />
                                {{ form.photo ? form.photo.name : 'Choisir une photo' }}
                            </button>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <Link href="/admin/joueurs">
                            <Button type="button" variant="outline">Annuler</Button>
                        </Link>
                        <Button type="submit" class="bg-cardinal hover:bg-cardinal-dark" :disabled="form.processing">
                            Enregistrer
                        </Button>
                    </div>
                </form>

                <div class="rounded-lg bg-white p-6 shadow">
                    <h2 class="mb-4 text-lg font-semibold text-raisin">Équipes</h2>
                    <div v-if="player.teams.length === 0" class="py-4 text-gray-500">
                        Ce joueur n'appartient à aucune équipe.
                    </div>
                    <ul v-else class="space-y-2">
                        <li v-for="team in player.teams" :key="team.id" class="flex items-center justify-between rounded border p-3">
                            <span class="font-medium">{{ team.name }}</span>
                            <span class="text-sm text-gray-500">{{ team.position }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
