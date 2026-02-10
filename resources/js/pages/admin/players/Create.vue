<script setup lang="ts">
import { useForm, Link } from '@inertiajs/vue3';
import { ArrowLeft, Upload } from 'lucide-vue-next';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AdminLayout from '@/layouts/AdminLayout.vue';

const form = useForm({
    first_name: '',
    last_name: '',
    birth_date: '',
    photo: null as File | null,
});

const submit = () => {
    form.post('/admin/joueurs');
};

const handlePhotoChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files?.[0]) {
        form.photo = target.files[0];
    }
};

const photoInput = ref<HTMLInputElement | null>(null);
</script>

<template>
    <AdminLayout title="Nouveau joueur">
        <div class="space-y-6">
            <div class="flex items-center gap-4">
                <Link href="/admin/joueurs">
                    <Button variant="ghost" size="sm" class="gap-2">
                        <ArrowLeft class="h-4 w-4" />
                        Retour
                    </Button>
                </Link>
                <h1 class="text-3xl font-bold uppercase tracking-tight text-raisin">Nouveau joueur</h1>
            </div>

            <form @submit.prevent="submit" class="max-w-xl rounded-lg bg-white p-6 shadow">
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
                        <Label for="birth_date">Date de naissance (optionnel)</Label>
                        <Input id="birth_date" v-model="form.birth_date" type="date" class="mt-1" />
                    </div>

                    <div>
                        <Label for="photo">Photo</Label>
                        <input
                            ref="photoInput"
                            id="photo"
                            type="file"
                            accept="image/*"
                            class="hidden"
                            @change="handlePhotoChange"
                        />
                        <button
                            type="button"
                            class="mt-1 inline-flex items-center gap-2 rounded-lg border-2 border-dashed border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-600 transition-colors hover:border-cardinal hover:text-cardinal"
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
                        Créer le joueur
                    </Button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
