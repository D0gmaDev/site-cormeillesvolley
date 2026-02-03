<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Home, Users, Trophy, Handshake, LogOut, Menu, X, Briefcase } from 'lucide-vue-next';
import { ref } from 'vue';

interface Props {
    title?: string;
}

withDefaults(defineProps<Props>(), {
    title: 'Administration',
});

const sidebarOpen = ref(false);

const navigation = [
    { name: 'Dashboard', href: '/admin', icon: Home },
    { name: 'Équipes', href: '/admin/equipes', icon: Trophy },
    { name: 'Joueurs', href: '/admin/joueurs', icon: Users },
    { name: 'Bureau', href: '/admin/bureau', icon: Briefcase },
    { name: 'Partenaires', href: '/admin/partenaires', icon: Handshake },
];

const logout = () => {
    router.post('/admin/logout');
};
</script>

<template>
    <Head :title="title" />
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar Desktop -->
        <aside class="hidden w-64 flex-shrink-0 bg-raisin lg:block">
            <div class="flex h-full flex-col">
                <div class="flex h-16 items-center justify-center border-b border-white/10">
                    <Link href="/admin" class="flex items-center gap-2">
                        <img src="/logo.png" alt="ACS Cormeilles" class="h-10" />
                        <span class="font-bold uppercase text-white">Admin</span>
                    </Link>
                </div>
                <nav class="flex-1 space-y-1 p-4">
                    <Link
                        v-for="item in navigation"
                        :key="item.name"
                        :href="item.href"
                        class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-white/70 transition-colors hover:bg-white/10 hover:text-white"
                    >
                        <component :is="item.icon" class="h-5 w-5" />
                        {{ item.name }}
                    </Link>
                </nav>
                <div class="border-t border-white/10 p-4">
                    <button
                        @click="logout"
                        class="flex w-full items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-white/70 transition-colors hover:bg-white/10 hover:text-white"
                    >
                        <LogOut class="h-5 w-5" />
                        Déconnexion
                    </button>
                    <Link
                        href="/"
                        class="mt-2 flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-white/50 transition-colors hover:text-white"
                    >
                        ← Voir le site
                    </Link>
                </div>
            </div>
        </aside>

        <!-- Mobile header -->
        <div class="flex flex-1 flex-col">
            <header class="flex h-16 items-center justify-between bg-white px-4 shadow lg:hidden">
                <Link href="/admin" class="flex items-center gap-2">
                    <img src="/logo.png" alt="ACS Cormeilles" class="h-8" />
                    <span class="font-bold uppercase text-raisin">Admin</span>
                </Link>
                <button @click="sidebarOpen = !sidebarOpen" class="p-2">
                    <Menu v-if="!sidebarOpen" class="h-6 w-6" />
                    <X v-else class="h-6 w-6" />
                </button>
            </header>

            <!-- Mobile sidebar -->
            <div v-if="sidebarOpen" class="fixed inset-0 z-50 lg:hidden" @click="sidebarOpen = false">
                <div class="absolute inset-0 bg-black/50" />
                <aside class="absolute left-0 top-0 h-full w-64 bg-raisin" @click.stop>
                    <div class="flex h-16 items-center justify-center border-b border-white/10">
                        <span class="font-bold uppercase text-white">Menu</span>
                    </div>
                    <nav class="space-y-1 p-4">
                        <Link
                            v-for="item in navigation"
                            :key="item.name"
                            :href="item.href"
                            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white"
                            @click="sidebarOpen = false"
                        >
                            <component :is="item.icon" class="h-5 w-5" />
                            {{ item.name }}
                        </Link>
                    </nav>
                </aside>
            </div>

            <!-- Main content -->
            <main class="flex-1 p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
