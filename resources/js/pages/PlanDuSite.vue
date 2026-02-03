<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

const sections = [
    {
        title: 'Accueil',
        links: [{ name: 'Page d\'accueil', href: '/' }],
    },
    {
        title: 'Club',
        links: [
            { name: 'Histoire', href: '/club/histoire' },
            { name: 'Bureau', href: '/club/bureau' },
            { name: 'Encadrement', href: '/club/encadrement' },
        ],
    },
    {
        title: 'Équipes',
        links: [
            { name: 'Seniors', href: '/equipes/seniors' },
            { name: 'Jeunes', href: '/equipes/jeunes' },
            { name: 'École de Volley', href: '/equipes/ecole-de-volley' },
            { name: 'Loisirs', href: '/equipes/loisirs' },
            { name: 'FSGT', href: '/equipes/fsgt' },
        ],
    },
    {
        title: 'Informations',
        links: [
            { name: 'Inscriptions', href: '/informations/inscriptions' },
            { name: 'Accès aux Gymnases', href: '/informations/acces-gymnases' },
            { name: 'Horaires Entraînements', href: '/informations/horaires' },
            { name: 'Contact', href: '/informations/contact' },
        ],
    },
    {
        title: 'Autres',
        links: [
            { name: 'Partenariat', href: '/partenariat' },
            { name: 'Mentions Légales', href: '/mentions-legales' },
        ],
    },
];
</script>

<template>
    <PublicLayout title="Plan du Site">
        <section class="bg-cardinal py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <h1 class="text-4xl font-extrabold uppercase tracking-tight text-white lg:text-5xl">
                    <span class="inline-block bg-raisin px-3 py-1">Plan du Site</span>
                </h1>
            </div>
        </section>

        <section class="py-16">
            <div class="mx-auto max-w-4xl px-4 lg:px-8">
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <div v-for="section in sections" :key="section.title" class="rounded-lg bg-white p-6 shadow">
                        <h2 class="mb-4 text-lg font-bold uppercase text-raisin">{{ section.title }}</h2>
                        <ul class="space-y-2">
                            <li v-for="link in section.links" :key="link.href">
                                <Link :href="link.href" class="text-gray-600 hover:text-cardinal">
                                    {{ link.name }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
