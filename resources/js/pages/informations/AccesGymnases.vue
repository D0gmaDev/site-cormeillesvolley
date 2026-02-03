<script setup lang="ts">
import { MapPin } from 'lucide-vue-next';
import PublicLayout from '@/layouts/PublicLayout.vue';

const gymnases = [
    {
        name: 'Centre sportif Gilles Boutantin',
        address:
            '100, rue de Saint-Germain, 95240 Cormeilles-en-Parisis',
        description: 'Halle de Compétition & Halle d\'Entraînement',
        image: '/images/gilles-boutantin.png',
        mapsQuery:
            'Centre sportif Gilles Boutantin, 95240 Cormeilles-en-Parisis',
    },
    {
        name: 'Gymnase Léo Tavarez',
        address: '129, rue de Saint-Germain, 95240 Cormeilles-en-Parisis',
        description: 'Gymnase de repli',
        image: '/images/leo-tavarez.jpg',
        mapsQuery: 'Gymnase Léo Tavarez, 95240 Cormeilles-en-Parisis',
    },
];
</script>

<template>
    <PublicLayout title="Accès aux Gymnases">
        <!-- Hero -->
        <section class="bg-cardinal py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <h1
                    class="text-4xl font-extrabold tracking-tight text-white uppercase lg:text-5xl"
                >
                    <span class="inline-block bg-raisin px-3 py-1"
                        >Accès aux Gymnases</span
                    >
                </h1>
            </div>
        </section>

        <!-- Content -->
        <section class="py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <div class="space-y-10">
                    <div
                        v-for="gym in gymnases"
                        :key="gym.name"
                        class="overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-black/5"
                    >
                        <!-- Card header -->
                        <div class="grid grid-cols-1 gap-0 md:grid-cols-5">
                            <!-- Image -->
                            <div class="relative md:col-span-2">
                                <img
                                    :src="gym.image"
                                    :alt="`Photo ${gym.name}`"
                                    class="h-64 w-full object-cover md:h-full"
                                    loading="lazy"
                                />
                                <div
                                    class="absolute inset-0 bg-linear-to-t from-black/40 via-black/0 to-black/0"
                                />
                                <div class="absolute bottom-4 left-4">
                                    <span
                                        class="inline-flex items-center rounded-full bg-white/90 px-3 py-1 text-xs font-bold tracking-wide text-raisin uppercase"
                                    >
                                        Gymnase
                                    </span>
                                </div>
                            </div>

                            <!-- Infos -->
                            <div class="p-6 md:col-span-3 md:p-8">
                                <h3
                                    class="text-2xl font-extrabold tracking-tight text-raisin uppercase"
                                >
                                    {{ gym.name }}
                                </h3>

                                <p
                                    v-if="gym.description"
                                    class="mt-2 text-sm text-gray-600"
                                >
                                    {{ gym.description }}
                                </p>

                                <div
                                    class="mt-5 flex items-start gap-3 text-gray-600"
                                >
                                    <MapPin
                                        class="mt-0.5 h-5 w-5 shrink-0 text-cardinal"
                                    />
                                    <span class="text-sm leading-relaxed">
                                        {{ gym.address }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Google Maps embed -->
                        <div class="border-t border-gray-100">
                            <div class="p-4 sm:p-6">
                                <h4
                                    class="text-sm font-extrabold tracking-wide text-raisin uppercase"
                                >
                                    Localisation
                                </h4>
                                <div
                                    class="mt-3 overflow-hidden rounded-2xl ring-1 ring-black/5"
                                >
                                    <iframe
                                        class="h-80 w-full"
                                        :src="`https://www.google.com/maps?q=${encodeURIComponent(gym.mapsQuery)}&output=embed`"
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
