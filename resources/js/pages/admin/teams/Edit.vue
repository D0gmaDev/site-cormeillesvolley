<script setup lang="ts">
import { useForm, Link, router } from '@inertiajs/vue3';
import { ArrowLeft, X, Upload, Trash2 } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AdminLayout from '@/layouts/AdminLayout.vue';

interface Player {
    id: number;
    name: string;
    number?: number;
    position?: string;
}

interface Team {
    id: number;
    name: string;
    slug: string;
    genre: string;
    section: string;
    niveau: string | null;
    photo: string | null;
    photo_url: string | null;
    ffvolley_embed_url: string | null;
    players: Player[];
}

interface Props {
    team: Team;
    allPlayers: { id: number; name: string }[];
    sections: string[];
    genres: string[];
}

const props = defineProps<Props>();

const form = useForm({
    name: props.team.name,
    slug: props.team.slug,
    genre: props.team.genre,
    section: props.team.section,
    niveau: props.team.niveau || '',
    ffvolley_embed_url: props.team.ffvolley_embed_url || '',
    photo: null as File | null,
    players: props.team.players.map((p) => ({
        id: p.id,
        number: p.number || null,
        position: p.position || '',
    })),
});

const positions = ['Coach', 'Pointu', 'Central', 'Réceptionneur-Attaquant', 'Passeur', 'Libéro', 'Complet'];
const positionsFeminines = ['Coach', 'Pointue', 'Centrale', 'Réceptionneuse-Attaquante', 'Passeuse', 'Libéro', 'Complète'];

const currentPositions = computed(() => (form.genre === 'F' ? positionsFeminines : positions));

const submit = () => {
    form.put(`/admin/equipes/${props.team.id}`);
};

const addPlayer = (playerId: number) => {
    if (!form.players.find((p) => p.id === playerId)) {
        form.players.push({ id: playerId, number: null, position: '' });
    }
};

const removePlayer = (index: number) => {
    form.players.splice(index, 1);
};

const getPlayerName = (id: number) => {
    return props.allPlayers.find((p) => p.id === id)?.name || 'Inconnu';
};

const handlePhotoChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files?.[0]) {
        form.photo = target.files[0];
    }
};

const photoInput = ref<HTMLInputElement | null>(null);

const deletePhoto = () => {
    if (confirm('Supprimer la photo d\'équipe ?')) {
        router.delete(`/admin/equipes/${props.team.id}/photo`, {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <AdminLayout :title="`Éditer ${team.name}`">
        <div class="space-y-6">
            <div class="flex items-center gap-4">
                <Link href="/admin/equipes">
                    <Button variant="ghost" size="sm" class="gap-2">
                        <ArrowLeft class="h-4 w-4" />
                        Retour
                    </Button>
                </Link>
                <h1 class="text-3xl font-bold uppercase tracking-tight text-raisin">Éditer {{ team.name }}</h1>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <div class="rounded-lg bg-white p-6 shadow">
                    <h2 class="mb-4 text-lg font-semibold text-raisin">Informations générales</h2>
                    <div class="space-y-4">
                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <Label for="name">Nom de l'équipe</Label>
                                <Input id="name" v-model="form.name" required class="mt-1" />
                            </div>
                            <div>
                                <Label for="slug">Slug</Label>
                                <Input id="slug" v-model="form.slug" required class="mt-1" />
                            </div>
                        </div>

                        <div class="grid gap-4 md:grid-cols-3">
                            <div>
                                <Label for="section">Section</Label>
                                <select id="section" v-model="form.section" class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2">
                                    <option v-for="s in sections" :key="s" :value="s">{{ s }}</option>
                                </select>
                            </div>
                            <div>
                                <Label for="genre">Genre</Label>
                                <select id="genre" v-model="form.genre" class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2">
                                    <option v-for="g in genres" :key="g" :value="g">
                                        {{ g === 'M' ? 'Masculin' : g === 'F' ? 'Féminin' : 'Mixte' }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <Label for="niveau">Niveau</Label>
                                <Input id="niveau" v-model="form.niveau" class="mt-1" />
                            </div>
                        </div>

                        <div>
                            <Label for="ffvolley_embed_url">URL embed FFVolley</Label>
                            <Input id="ffvolley_embed_url" v-model="form.ffvolley_embed_url" type="url" class="mt-1" />
                        </div>

                        <div>
                            <Label for="photo">Photo d'équipe</Label>
                            <div v-if="team.photo_url" class="mb-3 flex items-start gap-4">
                                <img :src="team.photo_url" alt="Photo actuelle" class="h-32 rounded object-cover" />
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
                </div>

                <div class="rounded-lg bg-white p-6 shadow">
                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-raisin">Effectif</h2>
                        <select class="rounded-md border border-gray-300 px-3 py-2 text-sm" @change="addPlayer(Number(($event.target as HTMLSelectElement).value))">
                            <option value="">Ajouter un joueur...</option>
                            <option v-for="player in allPlayers" :key="player.id" :value="player.id" :disabled="form.players.some((p) => p.id === player.id)">
                                {{ player.name }}
                            </option>
                        </select>
                    </div>

                    <div v-if="form.players.length === 0" class="py-8 text-center text-gray-500">
                        Aucun joueur dans cette équipe.
                    </div>

                    <div v-else class="space-y-2">
                        <div v-for="(player, index) in form.players" :key="player.id" class="flex items-center gap-4 rounded border p-3">
                            <span class="w-48 font-medium">{{ getPlayerName(player.id) }}</span>
                            <Input v-model.number="player.number" type="number" placeholder="N°" class="w-20" />
                            <select v-model="player.position" class="flex-1 rounded-md border border-gray-300 px-3 py-2">
                                <option value="">Sélectionner un poste...</option>
                                <option v-for="pos in currentPositions" :key="pos" :value="pos">{{ pos }}</option>
                            </select>
                            <Button type="button" variant="ghost" size="sm" @click="removePlayer(index)">
                                <X class="h-4 w-4 text-red-500" />
                            </Button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <Link href="/admin/equipes">
                        <Button type="button" variant="outline">Annuler</Button>
                    </Link>
                    <Button type="submit" class="bg-cardinal hover:bg-cardinal-dark" :disabled="form.processing">
                        Enregistrer
                    </Button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
