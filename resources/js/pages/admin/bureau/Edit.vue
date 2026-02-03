<script setup lang="ts">
import { useForm, Link } from '@inertiajs/vue3';
import { ArrowLeft } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AdminLayout from '@/layouts/AdminLayout.vue';

interface Player {
    id: number;
    full_name: string;
}

interface Role {
    id: number;
    name: string;
    order: number;
    player_id: number | null;
}

const props = defineProps<{
    role: Role;
    players: Player[];
}>();

const form = useForm({
    name: props.role.name,
    order: props.role.order,
    player_id: props.role.player_id,
});

const submit = () => {
    form.put(`/admin/bureau/${props.role.id}`);
};
</script>

<template>
    <AdminLayout title="Modifier le rôle">
        <div class="space-y-6">
            <div class="flex items-center gap-4">
                <Link href="/admin/bureau">
                    <Button variant="outline" size="sm">
                        <ArrowLeft class="h-4 w-4" />
                    </Button>
                </Link>
                <h1 class="text-3xl font-bold uppercase tracking-tight text-raisin">Modifier le rôle</h1>
            </div>

            <form class="max-w-2xl space-y-6 rounded-lg bg-white p-6 shadow" @submit.prevent="submit">
                <div class="space-y-2">
                    <Label for="name">Nom du rôle</Label>
                    <Input
                        id="name"
                        v-model="form.name"
                        type="text"
                        placeholder="Ex: Président, Secrétaire..."
                        required
                    />
                    <p v-if="form.errors.name" class="text-sm text-red-600">{{ form.errors.name }}</p>
                </div>

                <div class="space-y-2">
                    <Label for="order">Ordre d'affichage</Label>
                    <Input id="order" v-model.number="form.order" type="number" min="1" required />
                    <p v-if="form.errors.order" class="text-sm text-red-600">{{ form.errors.order }}</p>
                </div>

                <div class="space-y-2">
                    <Label for="player">Personne</Label>
                    <select
                        id="player"
                        v-model="form.player_id"
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2"
                        required
                    >
                        <option :value="null" disabled>Sélectionner une personne</option>
                        <option v-for="player in players" :key="player.id" :value="player.id">
                            {{ player.full_name }}
                        </option>
                    </select>
                    <p v-if="form.errors.player_id" class="text-sm text-red-600">{{ form.errors.player_id }}</p>
                </div>

                <div class="flex gap-4">
                    <Button type="submit" class="bg-cardinal hover:bg-cardinal-dark" :disabled="form.processing">
                        Enregistrer
                    </Button>
                    <Link href="/admin/bureau">
                        <Button type="button" variant="outline">Annuler</Button>
                    </Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
