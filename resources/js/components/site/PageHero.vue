<script setup lang="ts">
import { Sparkles } from '@lucide/vue';
import { siteAssets } from '@/lib/siteAssets';

defineProps<{
    badge?: string;
    title: string;
    subtitle?: string;
}>();
</script>

<template>
    <section class="site-page-hero">
        <div class="site-container">
            <div class="site-page-hero-panel">
                <span class="site-page-hero-orb site-page-hero-orb--one" />
                <span class="site-page-hero-orb site-page-hero-orb--two" />
                <span class="site-page-hero-ring" />

                <img
                    :src="siteAssets.star"
                    alt=""
                    class="site-page-hero-star"
                />
                <img
                    :src="siteAssets.purpleHeart"
                    alt=""
                    class="site-page-hero-heart"
                />
                <img
                    :src="siteAssets.flowers"
                    alt=""
                    class="site-page-hero-flowers"
                />

                <div class="site-page-hero-content">
                    <span v-if="badge" class="site-page-hero-badge">
                        <Sparkles class="size-4" />
                        {{ badge }}
                    </span>
                    <h1 class="site-display">{{ title }}</h1>
                    <p v-if="subtitle">{{ subtitle }}</p>
                </div>
            </div>
        </div>
    </section>
</template>
