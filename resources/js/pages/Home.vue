<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowRight } from 'lucide-vue-next';
import PublicLayout from '@/layouts/PublicLayout.vue';
</script>

<template>
    <PublicLayout title="Accueil">
        <!-- Hero Banner -->
        <section class="relative bg-cardinal py-24 lg:py-32">
            <div
                class="absolute inset-0 bg-cover bg-center opacity-20"
                style="background-image: url('/acsc-allstar.jpg')"
            />
            <div class="relative mx-auto max-w-7xl px-4 lg:px-8">
                <div class="max-w-3xl">
                    <h1
                        class="mb-6 text-4xl font-extrabold tracking-tight text-white uppercase lg:text-6xl"
                    >
                        <span class="inline-block bg-raisin px-3 py-1"
                            >ACS Cormeilles</span
                        >
                        <br />
                        <span class="mt-2 inline-block">Volley-Ball</span>
                    </h1>
                    <p class="mb-8 text-lg text-white/90">
                        Club de volley-ball de Cormeilles-en-Parisis depuis plus
                        de 60 ans. Rejoignez-nous pour vivre votre passion du
                        volley !
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <Link
                            href="/informations/inscriptions"
                            class="inline-flex items-center gap-2 bg-raisin px-6 py-3 text-sm font-semibold tracking-wide text-white uppercase transition-transform hover:scale-105"
                        >
                            S'inscrire
                            <ArrowRight class="h-4 w-4" />
                        </Link>
                        <Link
                            href="/club/histoire"
                            class="inline-flex items-center gap-2 border-2 border-white px-6 py-3 text-sm font-semibold tracking-wide text-white uppercase transition-colors hover:bg-white hover:text-cardinal"
                        >
                            Découvrir le club
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sections d'information -->
        <section class="py-16 lg:py-24">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <h2
                    class="mb-12 text-center text-3xl font-bold tracking-tight text-raisin uppercase"
                >
                    Le club en bref
                </h2>
                <div class="grid gap-8 md:grid-cols-3">
                    <!-- Card Équipes -->
                    <Link
                        href="/equipes/seniors"
                        class="group rounded-lg bg-white p-8 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl"
                    >
                        <div class="mb-4 text-5xl font-extrabold text-cardinal">
                            20+
                        </div>
                        <h3
                            class="mb-2 text-lg font-bold tracking-wide text-raisin uppercase"
                        >
                            Équipes
                        </h3>
                        <p class="text-sm text-gray-600">
                            Seniors, jeunes, loisirs...
                        </p>
                        <span
                            class="mt-4 inline-flex items-center text-sm font-medium text-cardinal group-hover:underline"
                        >
                            Voir les équipes <ArrowRight class="ml-1 h-4 w-4" />
                        </span>
                    </Link>

                    <!-- Card Gymnases -->
                    <Link
                        href="/informations/acces-gymnases"
                        class="group rounded-lg bg-white p-8 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl"
                    >
                        <div class="mb-4 text-5xl font-extrabold text-cardinal">
                            400+
                        </div>
                        <h3
                            class="mb-2 text-lg font-bold tracking-wide text-raisin uppercase"
                        >
                            Adhérents
                        </h3>
                        <p class="text-sm text-gray-600">
                            De plus en plus de licenciés
                        </p>
                        <span
                            class="mt-4 inline-flex items-center text-sm font-medium text-cardinal group-hover:underline"
                        >
                            Accès et plans <ArrowRight class="ml-1 h-4 w-4" />
                        </span>
                    </Link>

                    <!-- Card Encadrement -->
                    <Link
                        href="/club/encadrement"
                        class="group rounded-lg bg-white p-8 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl"
                    >
                        <div class="mb-4 text-5xl font-extrabold text-cardinal">
                            30+
                        </div>
                        <h3
                            class="mb-2 text-lg font-bold tracking-wide text-raisin uppercase"
                        >
                            Bénévoles
                        </h3>
                        <p class="text-sm text-gray-600">
                            Passionnés pour faire vivre le club
                        </p>
                        <span
                            class="mt-4 inline-flex items-center text-sm font-medium text-cardinal group-hover:underline"
                        >
                            Notre staff <ArrowRight class="ml-1 h-4 w-4" />
                        </span>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Liens externes -->
        <section class="bg-gray-50 py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <h2
                    class="mb-8 text-center text-2xl font-bold tracking-tight text-raisin uppercase"
                >
                    Liens utiles
                </h2>
                <div class="flex flex-wrap justify-center gap-4">
                    <a
                        href="https://acsc-volley95.monclub.app"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-raisin transition-colors hover:border-cardinal hover:text-cardinal"
                    >
                        MonClub – Gérer son adhésion
                    </a>
                    <a
                        href="https://www.ffvbbeach.org/ffvbapp/resu/planning_club.php?aff_semaine=&cnclub=0955773&x=17&y=13"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-raisin transition-colors hover:border-cardinal hover:text-cardinal"
                    >
                        FFVolley – Résultats officiels
                    </a>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
