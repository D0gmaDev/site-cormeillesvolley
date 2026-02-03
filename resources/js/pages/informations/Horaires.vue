<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue';
</script>

<template>
    <PublicLayout title="Horaires Entraînements">
        <!-- Hero -->
        <section class="bg-cardinal py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <h1
                    class="text-4xl font-extrabold tracking-tight text-white uppercase lg:text-5xl"
                >
                    <span class="inline-block bg-raisin px-3 py-1"
                        >Horaires</span
                    >
                </h1>
            </div>
        </section>

        <!-- Image -->
        <section class="py-16">
            <div class="mx-auto max-w-5xl px-4 lg:px-8">
                <div
                    class="overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-black/5"
                >
                    <img
                        src="/images/planning_2025_2026.jpg"
                        alt="Horaires des entraînements"
                        class="w-full object-contain"
                        loading="lazy"
                    />
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
