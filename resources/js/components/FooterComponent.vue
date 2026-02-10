<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { Mail, MapPin } from 'lucide-vue-next';

const currentYear = new Date().getFullYear();

interface Partner {
    id: number;
    name: string;
    logo_url: string;
    url: string | null;
}

const page = usePage<{ partners: Partner[] }>();
const partners = page.props.partners;

const usefulLinks = [
    { name: 'Mentions légales', href: '/mentions-legales' },
    { name: 'Plan du site', href: '/plan-du-site' },
    { name: 'Administration du site', href: '/admin' },
];
</script>

<template>
    <footer class="bg-raisin text-white">
        <!-- Carrousel partenaires -->
        <div class="border-b border-white/10 py-8">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <h3 class="mb-6 text-center text-sm font-semibold uppercase tracking-widest text-white/70">
                    Nos Partenaires
                </h3>
                <div v-if="partners.length" class="flex flex-wrap items-center justify-center gap-8">
                    <a
                        v-for="partner in partners"
                        :key="partner.id"
                        :href="partner.url || '#'"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="grayscale transition-all hover:grayscale-0"
                    >
                        <img
                            :src="partner.logo_url"
                            :alt="partner.name"
                            class="h-12 w-auto object-contain"
                        />
                    </a>
                </div>
            </div>
        </div>

        <!-- Contact & Liens utiles -->
        <div class="py-12">
            <div class="mx-auto grid max-w-7xl gap-8 px-4 lg:grid-cols-3 lg:px-8">
                <!-- Logo & Description -->
                <div>
                    <img src="/logo.png" alt="ACS Cormeilles Volley-Ball" class="mb-4 h-16 w-auto" />
                    <p class="text-sm text-white/70">
                        Club de volley-ball de Cormeilles-en-Parisis, affilié à la FFVolley.
                    </p>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="mb-4 text-sm font-semibold uppercase tracking-widest">Contact</h4>
                    <ul class="space-y-3 text-sm text-white/70">
                        <li class="flex items-start gap-2">
                            <Mail class="mt-0.5 h-4 w-4 shrink-0" />
                            <a href="mailto:contact@cormeillesvolley95.fr" class="hover:text-white">
                                contact@cormeillesvolley95.fr
                            </a>
                        </li>
                        <li class="flex items-start gap-2">
                            <MapPin class="mt-0.5 h-4 w-4 shrink-0" />
                            <span>Cormeilles-en-Parisis, 95240</span>
                        </li>
                    </ul>
                </div>

                <!-- Liens utiles -->
                <div>
                    <h4 class="mb-4 text-sm font-semibold uppercase tracking-widest">Liens utiles</h4>
                    <ul class="space-y-2 text-sm text-white/70">
                        <li v-for="link in usefulLinks" :key="link.name">
                            <Link :href="link.href" class="hover:text-white">
                                {{ link.name }}
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-white/10 py-6">
            <div class="mx-auto max-w-7xl px-4 text-center text-sm text-white/50 lg:px-8">
                © {{ currentYear }} – ACS Cormeilles Volley Ball – Tous droits réservés
            </div>
        </div>
    </footer>
</template>
