<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import PageHero from '@/components/site/PageHero.vue';
import { useTranslation } from '@/composables/useTranslation';
import SiteLayout from '@/layouts/SiteLayout.vue';
import type { GalleryItem, SiteSettings } from '@/types/site';

defineProps<{ settings: SiteSettings; items: GalleryItem[] }>();
const { t } = useTranslation();
</script>

<template>
    <Head :title="`${t('site.gallery.badge')} — ${settings.site_name}`" />
    <SiteLayout :settings="settings">
        <PageHero
            :badge="t('site.gallery.badge')"
            :title="t('site.gallery.title')"
            :subtitle="t('site.gallery.subtitle')"
        />

        <section class="site-section">
            <div class="site-container">
                <div class="site-gallery-masonry">
                    <figure
                        v-for="item in items"
                        :key="item.id"
                        class="site-gallery-masonry-item"
                    >
                        <img
                            :src="item.image_url || ''"
                            :alt="item.title"
                            loading="lazy"
                            decoding="async"
                        />
                        <figcaption>
                            {{ item.title }}
                        </figcaption>
                    </figure>
                </div>
            </div>
        </section>
    </SiteLayout>
</template>
