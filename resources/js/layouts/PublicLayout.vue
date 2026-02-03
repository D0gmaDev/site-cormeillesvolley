<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import FooterComponent from '@/components/FooterComponent.vue';
import TopBar from '@/components/TopBar.vue';

interface Props {
    title?: string;
}

withDefaults(defineProps<Props>(), {
    title: 'ACS Cormeilles Volley-Ball',
});
</script>

<template>
    <Head :title="title" />
    <div class="flex min-h-screen flex-col">
        <TopBar />
        <main class="flex-1">
            <slot />
        </main>
        <FooterComponent />
    </div>
</template>
