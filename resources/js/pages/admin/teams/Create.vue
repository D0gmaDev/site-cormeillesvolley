<script setup lang="ts">
import { useForm, Link } from '@inertiajs/vue3';
import { ArrowLeft } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AdminLayout from '@/layouts/AdminLayout.vue';

interface Props {
    sections: string[];
    genres: string[];
}

defineProps<Props>();

const form = useForm({
    name: '',
    slug: '',
    genre: 'M',
    section: 'Seniors',
    niveau: '',
    ffvolley_embed_url: '',
    photo: null as File | null,
});

const submit = () => {
    form.post('/admin/equipes');
};

const handlePhotoChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files?.[0]) {
        form.photo = target.files[0];
    }
};
</script>

<template>
    <AdminLayout title="Nouvelle équipe">
        <div class="space-y-6">
            <div class="flex items-center gap-4">
                <Link href="/admin/equipes">
                    <Button variant="ghost" size="sm" class="gap-2">
                        <ArrowLeft class="h-4 w-4" />
                        Retour
                    </Button>
                </Link>
                <h1 class="text-3xl font-bold uppercase tracking-tight text-raisin">Nouvelle équipe</h1>
            </div>

            <form @submit.prevent="submit" class="max-w-2xl rounded-lg bg-white p-6 shadow">
                <div class="space-y-4">
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <Label for="name">Nom de l'équipe</Label>
                            <Input id="name" v-model="form.name" required class="mt-1" />
                            <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                        </div>
                        <div>
                            <Label for="slug">Slug (ex: SM-1)</Label>
                            <Input id="slug" v-model="form.slug" required class="mt-1" />
                            <p v-if="form.errors.slug" class="mt-1 text-sm text-red-600">{{ form.errors.slug }}</p>
                        </div>
                    </div>

                    <div class="grid gap-4 md:grid-cols-3">
                        <div>
                            <Label for="section">Section</Label>
                            <select
                                id="section"
                                v-model="form.section"
                                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2"
                            >
                                <option v-for="s in sections" :key="s" :value="s">{{ s }}</option>
                            </select>
                        </div>
                        <div>
                            <Label for="genre">Genre</Label>
                            <select
                                id="genre"
                                v-model="form.genre"
                                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2"
                            >
                                <option v-for="g in genres" :key="g" :value="g">
                                    {{ g === 'M' ? 'Masculin' : g === 'F' ? 'Féminin' : 'Mixte' }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <Label for="niveau">Niveau (optionnel)</Label>
                            <Input id="niveau" v-model="form.niveau" class="mt-1" placeholder="Ex: Régional 1" />
                        </div>
                    </div>

                    <div>
                        <Label for="ffvolley_embed_url">URL embed FFVolley (optionnel)</Label>
                        <Input id="ffvolley_embed_url" v-model="form.ffvolley_embed_url" type="url" class="mt-1" />
                    </div>

                    <div>
                        <Label for="photo">Photo d'équipe</Label>
                        <input
                            id="photo"
                            type="file"
                            accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded file:border-0 file:bg-cardinal file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-cardinal-dark"
                            @change="handlePhotoChange"
                        />
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <Link href="/admin/equipes">
                        <Button type="button" variant="outline">Annuler</Button>
                    </Link>
                    <Button type="submit" class="bg-cardinal hover:bg-cardinal-dark" :disabled="form.processing">
                        Créer l'équipe
                    </Button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
