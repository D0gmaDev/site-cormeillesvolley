<script setup lang="ts">
import { Handshake } from 'lucide-vue-next';
import PublicLayout from '@/layouts/PublicLayout.vue';
</script>

<template>
    <PublicLayout title="Partenariat">
        <section class="bg-cardinal py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <h1 class="text-4xl font-extrabold uppercase tracking-tight text-white lg:text-5xl">
                    <span class="inline-block bg-raisin px-3 py-1">Partenariat</span>
                </h1>
            </div>
        </section>

        <section class="py-16">
            <div class="mx-auto max-w-3xl px-4 lg:px-8">
                <div class="rounded-lg bg-white p-8 shadow-lg">
                    <div class="mb-8 flex justify-center">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-cardinal/10">
                            <Handshake class="h-10 w-10 text-cardinal" />
                        </div>
                    </div>

                    <h2 class="mb-6 text-center text-2xl font-bold uppercase text-raisin">
                        Devenez partenaire
                    </h2>

                    <p class="mb-6 text-center text-gray-600">
                        L'ACS Cormeilles Volley-Ball vous propose de devenir partenaire du club
                        et de bénéficier d'une visibilité auprès de nos licenciés et leurs familles.
                    </p>

                    <div class="text-center">
                        <a
                            href="mailto:contact@cormeillesvolley95.fr?subject=Partenariat"
                            class="inline-flex items-center gap-2 rounded-lg bg-cardinal px-6 py-3 font-semibold text-white transition-colors hover:bg-cardinal-dark"
                        >
                            Contactez-nous
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
