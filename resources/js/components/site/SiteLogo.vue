<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{ asLink?: boolean }>();

const letters = [
    { char: 'М', color: '#FF6B9D' },
    { char: 'Е', color: '#FFD93D' },
    { char: 'Й', color: '#4ECDC4' },
    { char: 'І', color: '#FF9F43' },
    { char: 'Р', color: '#48DBFB' },
    { char: 'Ж', color: '#FF6B6B' },
    { char: 'А', color: '#6BCB77' },
    { char: 'Н', color: '#8A5CF5' },
];
</script>

<template>
    <component
        :is="asLink ? Link : 'div'"
        :href="asLink ? '/' : undefined"
        class="site-logo inline-flex items-center"
    >
        <span
            v-for="(l, i) in letters"
            :key="i"
            class="site-display text-[clamp(1.25rem,3vw,1.75rem)] leading-none font-black"
            :style="{ color: l.color }"
        >
            {{ l.char }}
        </span>
    </component>
</template>
