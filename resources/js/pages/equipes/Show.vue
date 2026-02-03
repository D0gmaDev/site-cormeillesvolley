<script setup lang="ts">
import PlayerCard from '@/components/PlayerCard.vue';
import PublicLayout from '@/layouts/PublicLayout.vue';

interface Player {
    id: number;
    full_name: string;
    photo_url: string;
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
    photo_url: string | null;
    ffvolley_embed_url: string | null;
    coachs: Player[];
    joueurs: Player[];
}

interface Props {
    team: Team;
}

defineProps<Props>();
</script>

<template>
    <PublicLayout :title="team.name">
        <!-- Header -->
        <section class="bg-cardinal py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <div class="flex items-center gap-3">
                    <span
                        class="inline-block rounded px-2 py-1 text-sm font-semibold uppercase"
                        :class="{
                            'bg-blue-500 text-white': team.genre === 'M',
                            'bg-pink-500 text-white': team.genre === 'F',
                            'bg-purple-500 text-white': team.genre === 'Mixte',
                        }"
                    >
                        {{ team.genre === 'M' ? 'Masculin' : team.genre === 'F' ? 'Féminin' : 'Mixte' }}
                    </span>
                    <span v-if="team.niveau" class="text-white/70">{{ team.niveau }}</span>
                </div>
                <h1 class="mt-4 text-4xl font-extrabold uppercase tracking-tight text-white lg:text-5xl">
                    <span class="inline-block bg-raisin px-3 py-1">{{ team.name }}</span>
                </h1>
            </div>
        </section>

        <!-- Photo d'équipe -->
        <section v-if="team.photo_url" class="py-8">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <img
                    :src="team.photo_url"
                    :alt="`Photo de l'équipe ${team.name}`"
                    class="w-full rounded-lg shadow-lg"
                />
            </div>
        </section>

        <!-- Coachs -->
        <section v-if="team.coachs.length > 0" class="py-12">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <h2 class="mb-8 text-2xl font-bold uppercase tracking-tight text-raisin">
                    <span class="border-b-4 border-cardinal pb-2">Encadrement</span>
                </h2>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <PlayerCard
                        v-for="coach in team.coachs"
                        :key="coach.id"
                        :name="coach.full_name"
                        role="Coach"
                        :photo="coach.photo_url"
                    />
                </div>
            </div>
        </section>

        <!-- Joueurs -->
        <section v-if="team.joueurs.length > 0" class="bg-gray-50 py-12">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <h2 class="mb-8 text-2xl font-bold uppercase tracking-tight text-raisin">
                    <span class="border-b-4 border-cardinal pb-2">Effectif</span>
                </h2>
                <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                    <PlayerCard
                        v-for="joueur in team.joueurs"
                        :key="joueur.id"
                        :name="joueur.full_name"
                        :role="joueur.position"
                        :number="joueur.number"
                        :photo="joueur.photo_url"
                    />
                </div>
            </div>
        </section>

        <!-- Résultats FFVolley -->
        <section v-if="team.ffvolley_embed_url" class="py-12">
            <div class="mx-auto max-w-5xl px-4 lg:px-8">
                <h2 class="mb-8 text-2xl font-bold uppercase tracking-tight text-raisin">
                    <span class="border-b-4 border-cardinal pb-2">Résultats</span>
                </h2>
                <div class="overflow-hidden rounded-lg bg-white shadow-lg">
                    <iframe
                        :src="team.ffvolley_embed_url"
                        class="h-[600px] w-full border-0"
                        title="Résultats FFVolley"
                    />
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
