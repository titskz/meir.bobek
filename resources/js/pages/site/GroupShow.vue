<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ArrowLeft, Sparkles } from '@lucide/vue';
import PageHero from '@/components/site/PageHero.vue';
import { useTranslation } from '@/composables/useTranslation';
import SiteLayout from '@/layouts/SiteLayout.vue';
import type { CmsGroup, SiteSettings } from '@/types/site';

defineProps<{ settings: SiteSettings; group: CmsGroup }>();
const { t } = useTranslation();
</script>

<template>
    <Head :title="`${group.title} — ${settings.site_name}`" />

    <SiteLayout :settings="settings">
        <PageHero
            :badge="t('site.groups.badge')"
            :title="group.title"
            :subtitle="t('site.group.subtitle')"
        />

        <section class="site-section">
            <div class="site-container">
                <Link href="/groups" class="site-group-back">
                    <ArrowLeft />
                    {{ t('site.group.back') }}
                </Link>

                <article class="site-group-detail">
                    <div v-if="group.image_url" class="site-group-detail-media">
                        <img :src="group.image_url" :alt="group.title" />
                    </div>

                    <div class="site-group-detail-copy">
                        <span class="site-group-detail-label">
                            <Sparkles />
                            {{ t('site.groups.card_label') }}
                        </span>
                        <h2 class="site-display">{{ group.title }}</h2>
                        <div
                            class="site-group-detail-content"
                            v-html="group.content"
                        />
                    </div>
                </article>
            </div>
        </section>
    </SiteLayout>
</template>
