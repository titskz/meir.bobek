<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import PageHero from '@/components/site/PageHero.vue';
import SiteLayout from '@/layouts/SiteLayout.vue';
import type { CmsPage, SiteSettings } from '@/types/site';

defineProps<{ settings: SiteSettings; page: CmsPage }>();
</script>

<template>
    <Head :title="`${page.title} — ${settings.site_name}`" />
    <SiteLayout :settings="settings">
        <PageHero :title="page.title" />

        <section class="site-section">
            <div class="site-container">
                <article class="site-content-card">
                    <img
                        v-if="page.image_url"
                        :src="page.image_url"
                        :alt="page.title"
                        class="site-content-card-image"
                        decoding="async"
                    />
                    <div class="site-content-card-body">
                        <div class="site-prose" v-html="page.content" />
                    </div>
                </article>
            </div>
        </section>
    </SiteLayout>
</template>
