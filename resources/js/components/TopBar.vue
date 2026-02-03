<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Menu, X } from 'lucide-vue-next';
import { ref } from 'vue';
import {
    NavigationMenu,
    NavigationMenuContent,
    NavigationMenuItem,
    NavigationMenuLink,
    NavigationMenuList,
    NavigationMenuTrigger,
} from '@/components/ui/navigation-menu';

const mobileMenuOpen = ref(false);

const navigation = [
    { name: 'Accueil', href: '/' },
    {
        name: 'Club',
        children: [
            { name: 'Histoire', href: '/club/histoire' },
            { name: 'Bureau', href: '/club/bureau' },
            { name: 'Encadrement', href: '/club/encadrement' },
        ],
    },
    {
        name: 'Équipes',
        children: [
            { name: 'Seniors', href: '/equipes/seniors' },
            { name: 'Jeunes', href: '/equipes/jeunes' },
            { name: 'École de Volley', href: '/equipes/ecole-de-volley' },
            { name: 'Loisirs', href: '/equipes/loisirs' },
            { name: 'FSGT', href: '/equipes/fsgt' },
        ],
    },
    {
        name: 'Informations',
        children: [
            { name: 'Inscriptions', href: '/informations/inscriptions' },
            { name: 'Accès aux Gymnases', href: '/informations/acces-aux-gymnases' },
            { name: 'Horaires Entraînements', href: '/informations/horaires-entrainements' },
            { name: 'Contact', href: '/informations/contact' },
        ],
    },
    { name: 'Partenariat', href: '/partenaires/devenir-notre-partenaire' },
];
</script>

<template>
    <header class="sticky top-0 z-50 bg-white shadow-sm">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 lg:px-8">
            <!-- Logo -->
            <Link href="/" class="flex items-center gap-3">
                <img src="/logo.png" alt="ACS Cormeilles Volley-Ball" class="h-12 w-auto" />
                <span class="hidden text-lg font-bold uppercase tracking-tight text-raisin sm:block">
                    ACS Cormeilles Volley-Ball
                </span>
            </Link>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex lg:items-center lg:gap-1">
                <NavigationMenu>
                    <NavigationMenuList>
                        <template v-for="item in navigation" :key="item.name">
                            <!-- Simple link -->
                            <NavigationMenuItem v-if="!item.children">
                                <NavigationMenuLink as-child>
                                    <Link
                                        :href="item.href!"
                                        class="px-4 py-2 text-sm font-semibold uppercase tracking-wide text-raisin transition-colors hover:text-cardinal"
                                    >
                                        {{ item.name }}
                                    </Link>
                                </NavigationMenuLink>
                            </NavigationMenuItem>

                            <!-- Dropdown -->
                            <NavigationMenuItem v-else>
                                <NavigationMenuTrigger
                                    class="bg-transparent px-4 py-2 text-sm font-semibold uppercase tracking-wide text-raisin transition-colors hover:bg-transparent hover:text-cardinal focus:bg-transparent data-[state=open]:bg-transparent data-[state=open]:text-cardinal"
                                >
                                    {{ item.name }}
                                </NavigationMenuTrigger>
                                <NavigationMenuContent>
                                    <ul class="w-48 p-2">
                                        <li v-for="child in item.children" :key="child.name">
                                            <NavigationMenuLink as-child>
                                                <Link
                                                    :href="child.href"
                                                    class="block rounded-md px-4 py-2 text-sm font-medium text-raisin transition-colors hover:bg-cardinal hover:text-white"
                                                >
                                                    {{ child.name }}
                                                </Link>
                                            </NavigationMenuLink>
                                        </li>
                                    </ul>
                                </NavigationMenuContent>
                            </NavigationMenuItem>
                        </template>
                    </NavigationMenuList>
                </NavigationMenu>
            </div>

            <!-- Mobile menu button -->
            <button
                type="button"
                class="lg:hidden rounded-md p-2 text-raisin hover:bg-gray-100"
                @click="mobileMenuOpen = !mobileMenuOpen"
            >
                <span class="sr-only">Ouvrir le menu</span>
                <Menu v-if="!mobileMenuOpen" class="h-6 w-6" />
                <X v-else class="h-6 w-6" />
            </button>
        </nav>

        <!-- Mobile Navigation -->
        <div v-if="mobileMenuOpen" class="lg:hidden border-t bg-white">
            <div class="space-y-1 px-4 py-3">
                <template v-for="item in navigation" :key="item.name">
                    <Link
                        v-if="!item.children"
                        :href="item.href!"
                        class="block py-2 text-sm font-semibold uppercase tracking-wide text-raisin"
                        @click="mobileMenuOpen = false"
                    >
                        {{ item.name }}
                    </Link>
                    <div v-else>
                        <div class="py-2 text-sm font-semibold uppercase tracking-wide text-raisin">
                            {{ item.name }}
                        </div>
                        <div class="ml-4 space-y-1">
                            <Link
                                v-for="child in item.children"
                                :key="child.name"
                                :href="child.href"
                                class="block py-1.5 text-sm text-gray-600 hover:text-cardinal"
                                @click="mobileMenuOpen = false"
                            >
                                {{ child.name }}
                            </Link>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </header>
</template>
