<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

interface Team {
    id: number;
    name: string;
    slug: string;
    genre: string;
    niveau: string | null;
}

interface Props {
    section: string;
    teams: Team[];
}

defineProps<Props>();
</script>

<template>
    <PublicLayout :title="`Équipes ${section}`">
        <section class="bg-cardinal py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <h1 class="text-4xl font-extrabold uppercase tracking-tight text-white lg:text-5xl">
                    <span class="inline-block bg-raisin px-3 py-1">{{ section }}</span>
                </h1>
            </div>
        </section>

        <section class="py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <div v-if="teams.length === 0" class="text-center text-gray-600">
                    Aucune équipe dans cette catégorie pour le moment.
                </div>

                <div v-else class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <Link
                        v-for="team in teams"
                        :key="team.id"
                        :href="`/equipe/${team.slug}`"
                        class="group rounded-lg bg-white p-6 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl"
                    >
                        <div class="mb-2 flex items-center gap-2">
                            <span
                                class="inline-block rounded px-2 py-0.5 text-xs font-semibold uppercase"
                                :class="{
                                    'bg-blue-100 text-blue-800': team.genre === 'M',
                                    'bg-pink-100 text-pink-800': team.genre === 'F',
                                    'bg-purple-100 text-purple-800': team.genre === 'Mixte',
                                }"
                            >
                                {{ team.genre === 'M' ? 'Masculin' : team.genre === 'F' ? 'Féminin' : 'Mixte' }}
                            </span>
                            <span v-if="team.niveau" class="text-xs text-gray-500">
                                {{ team.niveau }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold uppercase tracking-wide text-raisin group-hover:text-cardinal">
                            {{ team.name }}
                        </h3>
                    </Link>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
