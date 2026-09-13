<script setup lang="ts">
defineProps<{
    badge?: string;
    title: string;
    subtitle?: string;
    centered?: boolean;
}>();
</script>

<template>
    <div
        class="mb-12 lg:mb-16"
        :class="centered ? 'mx-auto max-w-2xl text-center' : 'max-w-xl'"
    >
        <span v-if="badge" class="site-badge mb-4">{{ badge }}</span>
        <h2
            class="site-display text-3xl font-extrabold text-[var(--site-ink)] sm:text-4xl lg:text-[2.75rem] lg:leading-tight"
        >
            {{ title }}
        </h2>
        <p
            v-if="subtitle"
            class="mt-4 text-base leading-relaxed text-[var(--site-muted)] sm:text-lg"
        >
            {{ subtitle }}
        </p>
    </div>
</template>
