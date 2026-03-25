<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowRight, Users, MapPin, Heart, ExternalLink } from 'lucide-vue-next';
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
        <section class="bg-gradient-to-b from-white to-gray-50 py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <div class="mb-14 text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-raisin uppercase lg:text-4xl">
                        Le club en bref
                    </h2>
                    <div class="mx-auto mt-3 h-1 w-16 rounded-full bg-cardinal"></div>
                </div>
                <div class="grid gap-8 md:grid-cols-3">
                    <!-- Card Équipes -->
                    <Link
                        href="/equipes/seniors"
                        class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-md ring-1 ring-gray-100 transition-all hover:-translate-y-1.5 hover:shadow-xl hover:ring-cardinal/20"
                    >
                        <div class="absolute top-0 right-0 h-24 w-24 -translate-y-6 translate-x-6 rounded-full bg-cardinal/5 transition-transform group-hover:scale-150"></div>
                        <div class="relative">
                            <div class="mb-4 inline-flex rounded-xl bg-cardinal/10 p-3">
                                <Users class="h-6 w-6 text-cardinal" />
                            </div>
                            <div class="mb-2 text-4xl font-extrabold text-cardinal">
                                26+
                            </div>
                            <h3 class="mb-2 text-lg font-bold tracking-wide text-raisin uppercase">
                                Équipes
                            </h3>
                            <p class="text-sm leading-relaxed text-gray-500">
                                Seniors, jeunes, loisirs... un créneau pour chacun.
                            </p>
                            <span class="mt-5 inline-flex items-center text-sm font-semibold text-cardinal group-hover:underline">
                                Voir les équipes <ArrowRight class="ml-1.5 h-4 w-4 transition-transform group-hover:translate-x-1" />
                            </span>
                        </div>
                    </Link>

                    <!-- Card Adhérents -->
                    <Link
                        href="/informations/acces-aux-gymnases"
                        class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-md ring-1 ring-gray-100 transition-all hover:-translate-y-1.5 hover:shadow-xl hover:ring-cardinal/20"
                    >
                        <div class="absolute top-0 right-0 h-24 w-24 -translate-y-6 translate-x-6 rounded-full bg-cardinal/5 transition-transform group-hover:scale-150"></div>
                        <div class="relative">
                            <div class="mb-4 inline-flex rounded-xl bg-cardinal/10 p-3">
                                <MapPin class="h-6 w-6 text-cardinal" />
                            </div>
                            <div class="mb-2 text-4xl font-extrabold text-cardinal">
                                450+
                            </div>
                            <h3 class="mb-2 text-lg font-bold tracking-wide text-raisin uppercase">
                                Adhérents
                            </h3>
                            <p class="text-sm leading-relaxed text-gray-500">
                                De plus en plus de licenciés chaque saison.
                            </p>
                            <span class="mt-5 inline-flex items-center text-sm font-semibold text-cardinal group-hover:underline">
                                Accès et plans <ArrowRight class="ml-1.5 h-4 w-4 transition-transform group-hover:translate-x-1" />
                            </span>
                        </div>
                    </Link>

                    <!-- Card Bénévoles -->
                    <Link
                        href="/club/encadrement"
                        class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-md ring-1 ring-gray-100 transition-all hover:-translate-y-1.5 hover:shadow-xl hover:ring-cardinal/20"
                    >
                        <div class="absolute top-0 right-0 h-24 w-24 -translate-y-6 translate-x-6 rounded-full bg-cardinal/5 transition-transform group-hover:scale-150"></div>
                        <div class="relative">
                            <div class="mb-4 inline-flex rounded-xl bg-cardinal/10 p-3">
                                <Heart class="h-6 w-6 text-cardinal" />
                            </div>
                            <div class="mb-2 text-4xl font-extrabold text-cardinal">
                                40+
                            </div>
                            <h3 class="mb-2 text-lg font-bold tracking-wide text-raisin uppercase">
                                Bénévoles
                            </h3>
                            <p class="text-sm leading-relaxed text-gray-500">
                                Passionnés pour faire vivre le club au quotidien.
                            </p>
                            <span class="mt-5 inline-flex items-center text-sm font-semibold text-cardinal group-hover:underline">
                                Notre staff <ArrowRight class="ml-1.5 h-4 w-4 transition-transform group-hover:translate-x-1" />
                            </span>
                        </div>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Liens externes -->
        <section class="border-t border-gray-200 bg-gray-50 py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <div class="mb-10 text-center">
                    <h2 class="text-2xl font-bold tracking-tight text-raisin uppercase">
                        Liens utiles
                    </h2>
                    <div class="mx-auto mt-3 h-1 w-12 rounded-full bg-cardinal"></div>
                </div>
                <div class="flex flex-wrap justify-center gap-4">
                    <a
                        href="https://acsc-volley95.monclub.app"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2.5 rounded-xl border border-gray-200 bg-white px-6 py-3.5 text-sm font-medium text-raisin shadow-sm transition-all hover:-translate-y-0.5 hover:border-cardinal hover:text-cardinal hover:shadow-md"
                    >
                        <ExternalLink class="h-4 w-4" />
                        MonClub – Gérer son adhésion
                    </a>
                    <a
                        href="https://www.ffvbbeach.org/ffvbapp/resu/planning_club.php?aff_semaine=&cnclub=0955773&x=17&y=13"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2.5 rounded-xl border border-gray-200 bg-white px-6 py-3.5 text-sm font-medium text-raisin shadow-sm transition-all hover:-translate-y-0.5 hover:border-cardinal hover:text-cardinal hover:shadow-md"
                    >
                        <ExternalLink class="h-4 w-4" />
                        FFVolley – Résultats officiels
                    </a>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
