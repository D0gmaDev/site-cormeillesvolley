<script setup lang="ts">
import { Mail, MapPin } from 'lucide-vue-next';
import PublicLayout from '@/layouts/PublicLayout.vue';
</script>

<template>
    <PublicLayout title="Contact">
        <section class="bg-cardinal py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <h1 class="text-4xl font-extrabold uppercase tracking-tight text-white lg:text-5xl">
                    <span class="inline-block bg-raisin px-3 py-1">Contact</span>
                </h1>
            </div>
        </section>

        <section class="py-16">
            <div class="mx-auto max-w-3xl px-4 lg:px-8">
                <div class="rounded-lg bg-white p-8 shadow-lg">
                    <h2 class="mb-8 text-2xl font-bold uppercase text-raisin">Nous contacter</h2>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-cardinal/10">
                                <Mail class="h-6 w-6 text-cardinal" />
                            </div>
                            <div>
                                <h3 class="font-semibold text-raisin">Email</h3>
                                <a href="mailto:contact@cormeillesvolley95.fr" class="text-gray-600 hover:text-cardinal">
                                    contact@cormeillesvolley95.fr
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-cardinal/10">
                                <MapPin class="h-6 w-6 text-cardinal" />
                            </div>
                            <div>
                                <h3 class="font-semibold text-raisin">Adresse</h3>
                                <p class="text-gray-600">
                                    Centre Sportif Gilles Boutantin<br />
                                    100, rue de Saint-Germain<br />
                                    95240 Cormeilles-en-Parisis
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 border-t pt-8">
                        <h3 class="mb-4 font-semibold text-raisin">Suivez-nous</h3>
                        <div class="flex gap-4">
                            <a
                                href="https://www.facebook.com/acscormeillesvolleyball/"
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-raisin text-white transition-colors hover:bg-cardinal"
                            >
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <a
                                href="https://www.instagram.com/acscormeilles_volleyball/"
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-raisin text-white transition-colors hover:bg-cardinal"
                            >
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
