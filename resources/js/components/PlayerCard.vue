<script setup lang="ts">
interface Props {
    name: string;
    role?: string;
    number?: number;
    photo?: string | null;
}

withDefaults(defineProps<Props>(), {
    role: undefined,
    number: undefined,
    photo: null,
});
</script>

<template>
    <div
        class="group overflow-hidden rounded-lg bg-white shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl"
    >
        <div class="aspect-3/4 overflow-hidden bg-gray-200">
            <img
                v-if="photo"
                :src="photo"
                :alt="name"
                class="h-full w-full object-cover transition-transform group-hover:scale-105"
            />
            <div
                v-else
                class="flex h-full items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300"
            >
                <svg
                    class="h-20 w-20 text-gray-400"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"
                    />
                </svg>
            </div>
        </div>
        <div class="p-4">
            <div class="flex items-start justify-between">
                <div>
                    <span
                        v-if="number"
                        class="font-bold text-cardinal"
                    >
                        #{{ number }}
                    </span>
                    <h3 class="font-bold tracking-wide text-raisin uppercase">
                        {{ name }}
                    </h3>
                    <p v-if="role" class="mt-1 text-sm text-gray-600">
                        {{ role }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
