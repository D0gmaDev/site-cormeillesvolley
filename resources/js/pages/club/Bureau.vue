<script setup lang="ts">
import PlayerCard from '@/components/PlayerCard.vue';
import PublicLayout from '@/layouts/PublicLayout.vue';

interface Member {
    id: number;
    name: string;
    role: string;
    photo_url: string;
}

defineProps<{
    members: Member[];
}>();
</script>

<template>
    <PublicLayout title="Bureau">
        <section class="bg-cardinal py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <h1 class="text-4xl font-extrabold uppercase tracking-tight text-white lg:text-5xl">
                    <span class="inline-block bg-raisin px-3 py-1">Le Bureau</span>
                </h1>
            </div>
        </section>

        <section class="py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <p class="mb-12 text-center text-lg text-gray-600">
                    L'équipe dirigeante qui assure le bon fonctionnement du club.
                </p>

                <div v-if="members.length" class="grid gap-8 md:grid-cols-3">
                    <PlayerCard
                        v-for="member in members"
                        :key="member.id"
                        :name="member.name"
                        :role="member.role"
                        :photo="member.photo_url"
                    />
                </div>
                <p v-else class="text-center text-gray-500">
                    Aucun membre du bureau n'a été ajouté pour le moment.
                </p>
            </div>
        </section>
    </PublicLayout>
</template>
