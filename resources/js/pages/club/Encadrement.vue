<script setup lang="ts">
import PlayerCard from '@/components/PlayerCard.vue';
import PublicLayout from '@/layouts/PublicLayout.vue';

interface Coach {
    id: number;
    name: string;
    role: string;
    photo_url: string;
}

defineProps<{
    coaches: Coach[];
}>();
</script>

<template>
    <PublicLayout title="Encadrement">
        <section class="bg-cardinal py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <h1 class="text-4xl font-extrabold uppercase tracking-tight text-white lg:text-5xl">
                    <span class="inline-block bg-raisin px-3 py-1">L'Encadrement</span>
                </h1>
            </div>
        </section>

        <section class="py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <p class="mb-12 text-center text-lg text-gray-600">
                    Des bénévoles passionnés pour accompagner tous les joueurs, des débutants aux compétiteurs.
                </p>

                <div v-if="coaches.length" class="grid gap-8 md:grid-cols-4">
                    <PlayerCard
                        v-for="coach in coaches"
                        :key="coach.id"
                        :name="coach.name"
                        :role="coach.role"
                        :photo="coach.photo_url"
                    />
                </div>
                <p v-else class="text-center text-gray-500">
                    Aucun encadrant n'a été ajouté pour le moment.
                </p>
            </div>
        </section>
    </PublicLayout>
</template>
