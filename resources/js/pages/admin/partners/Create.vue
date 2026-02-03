<script setup lang="ts">
import { useForm, Link } from '@inertiajs/vue3';
import { ArrowLeft } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AdminLayout from '@/layouts/AdminLayout.vue';

const form = useForm({
    name: '',
    url: '',
    order: 0,
    logo: null as File | null,
});

const submit = () => {
    form.post('/admin/partenaires');
};

const handleLogoChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files?.[0]) {
        form.logo = target.files[0];
    }
};
</script>

<template>
    <AdminLayout title="Nouveau partenaire">
        <div class="space-y-6">
            <div class="flex items-center gap-4">
                <Link href="/admin/partenaires">
                    <Button variant="ghost" size="sm" class="gap-2">
                        <ArrowLeft class="h-4 w-4" />
                        Retour
                    </Button>
                </Link>
                <h1 class="text-3xl font-bold uppercase tracking-tight text-raisin">Nouveau partenaire</h1>
            </div>

            <form @submit.prevent="submit" class="max-w-xl rounded-lg bg-white p-6 shadow">
                <div class="space-y-4">
                    <div>
                        <Label for="name">Nom du partenaire</Label>
                        <Input id="name" v-model="form.name" required class="mt-1" />
                    </div>

                    <div>
                        <Label for="url">Site web (optionnel)</Label>
                        <Input id="url" v-model="form.url" type="url" class="mt-1" placeholder="https://..." />
                    </div>

                    <div>
                        <Label for="order">Ordre d'affichage</Label>
                        <Input id="order" v-model.number="form.order" type="number" class="mt-1" />
                    </div>

                    <div>
                        <Label for="logo">Logo</Label>
                        <input
                            id="logo"
                            type="file"
                            accept="image/*"
                            required
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded file:border-0 file:bg-cardinal file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white"
                            @change="handleLogoChange"
                        />
                        <p v-if="form.errors.logo" class="mt-1 text-sm text-red-600">{{ form.errors.logo }}</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <Link href="/admin/partenaires">
                        <Button type="button" variant="outline">Annuler</Button>
                    </Link>
                    <Button type="submit" class="bg-cardinal hover:bg-cardinal-dark" :disabled="form.processing">
                        Créer le partenaire
                    </Button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
