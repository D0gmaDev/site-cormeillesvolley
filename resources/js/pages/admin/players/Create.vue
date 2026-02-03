<script setup lang="ts">
import { useForm, Link } from '@inertiajs/vue3';
import { ArrowLeft } from 'lucide-vue-next';
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
                            id="photo"
                            type="file"
                            accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded file:border-0 file:bg-cardinal file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white"
                            @change="handlePhotoChange"
                        />
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
