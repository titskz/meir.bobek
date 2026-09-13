<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Sparkles } from '@lucide/vue';
import PageHero from '@/components/site/PageHero.vue';
import { useTranslation } from '@/composables/useTranslation';
import SiteLayout from '@/layouts/SiteLayout.vue';
import type { CmsGroup, SiteSettings } from '@/types/site';

defineProps<{ settings: SiteSettings; groups: CmsGroup[] }>();
const { t } = useTranslation();
</script>

<template>
    <Head :title="`${t('site.groups.badge')} — ${settings.site_name}`" />
    <SiteLayout :settings="settings">
        <PageHero
            :badge="t('site.groups.badge')"
            :title="t('site.groups.title')"
            :subtitle="t('site.groups.subtitle')"
        />

        <section class="site-section">
            <div class="site-container">
                <div class="site-groups-page-grid">
                    <Link
                        v-for="(group, index) in groups"
                        :key="group.id"
                        :href="`/groups/${group.slug}`"
                        class="site-groups-page-card"
                    >
                        <div class="site-groups-page-media">
                            <img
                                :src="group.image_url || ''"
                                :alt="group.title"
                            />
                            <span class="site-groups-page-number"
                                >0{{ index + 1 }}</span
                            >
                            <div class="site-groups-page-overlay" />
                            <h2 class="site-display">
                                {{ group.title }}
                            </h2>
                        </div>

                        <div class="site-groups-page-body">
                            <span class="site-groups-page-label">
                                <Sparkles class="size-4" />
                                {{ t('site.groups.card_label') }}
                            </span>
                            <div
                                class="site-groups-page-content"
                                v-html="group.content"
                            />
                        </div>
                    </Link>
                </div>
            </div>
        </section>
    </SiteLayout>
</template>
