<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps<{
    stats: {
        teams: number;
        players: number;
        partners: number;
    };
}>();
</script>

<template>
    <AdminLayout title="Dashboard">
        <Head title="Dashboard Admin" />
        <div class="space-y-6">
            <h1 class="text-3xl font-bold uppercase tracking-tight text-raisin">
                Dashboard
            </h1>
            <p class="text-gray-600">
                Bienvenue dans l'espace d'administration du site ACS Cormeilles Volley-Ball.
            </p>

            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded-lg bg-white p-6 shadow">
                    <div class="text-3xl font-bold text-cardinal">{{ stats.teams }}</div>
                    <div class="mt-1 text-sm text-gray-600">Équipes</div>
                </div>
                <div class="rounded-lg bg-white p-6 shadow">
                    <div class="text-3xl font-bold text-cardinal">{{ stats.players }}</div>
                    <div class="mt-1 text-sm text-gray-600">Joueurs</div>
                </div>
                <div class="rounded-lg bg-white p-6 shadow">
                    <div class="text-3xl font-bold text-cardinal">{{ stats.partners }}</div>
                    <div class="mt-1 text-sm text-gray-600">Partenaires</div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
