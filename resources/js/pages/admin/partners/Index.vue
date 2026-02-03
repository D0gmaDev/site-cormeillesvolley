<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { Plus, Pencil, Trash2 } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import AdminLayout from '@/layouts/AdminLayout.vue';

interface Partner {
    id: number;
    name: string;
    logo_url: string;
    url: string | null;
    order: number;
}

interface Props {
    partners: Partner[];
}

defineProps<Props>();

const deletePartner = (partner: Partner) => {
    if (confirm(`Supprimer le partenaire "${partner.name}" ?`)) {
        router.delete(`/admin/partenaires/${partner.id}`);
    }
};
</script>

<template>
    <AdminLayout title="Partenaires">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold uppercase tracking-tight text-raisin">Partenaires</h1>
                <Link href="/admin/partenaires/create">
                    <Button class="gap-2 bg-cardinal hover:bg-cardinal-dark">
                        <Plus class="h-4 w-4" />
                        Nouveau partenaire
                    </Button>
                </Link>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="partner in partners"
                    :key="partner.id"
                    class="flex flex-col rounded-lg bg-white p-4 shadow"
                >
                    <div class="mb-4 flex h-24 items-center justify-center bg-gray-50">
                        <img :src="partner.logo_url" :alt="partner.name" class="max-h-full max-w-full object-contain" />
                    </div>
                    <h3 class="mb-1 font-semibold text-raisin">{{ partner.name }}</h3>
                    <p v-if="partner.url" class="mb-4 truncate text-sm text-gray-500">{{ partner.url }}</p>
                    <div class="mt-auto flex gap-2">
                        <Link :href="`/admin/partenaires/${partner.id}/edit`" class="flex-1">
                            <Button size="sm" variant="outline" class="w-full gap-1">
                                <Pencil class="h-3 w-3" />
                                Éditer
                            </Button>
                        </Link>
                        <Button size="sm" variant="outline" class="text-red-600 hover:bg-red-50" @click="deletePartner(partner)">
                            <Trash2 class="h-3 w-3" />
                        </Button>
                    </div>
                </div>

                <div v-if="partners.length === 0" class="col-span-full py-8 text-center text-gray-500">
                    Aucun partenaire pour le moment.
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
